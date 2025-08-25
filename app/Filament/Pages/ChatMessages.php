<?php

namespace App\Filament\Pages;

use App\Models\Message;
use App\Models\Merchant;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ChatMessages extends Page
{
    use WithPagination;
    public static function getNavigationGroup(): ?string
    {
        return __('Customer Service');
    }
    public $merchants = [];
    public $selectedMerchantId = null;
    public $selectedMerchant = null;
    public $newMessage = '';
    public $perPage = 20;

    public $lastMessageIdByMerchant = [];
    public $lastTotalUnread = 0;

    protected $paginationTheme = 'tailwind';

    protected $listeners = [
        'sendMessageFromJs' => 'sendMessage',
    ];

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static string $view = 'filament.pages.chat-messages';


    public static function getNavigationBadge(): ?string
    {
        return Message::where('receiver_id', Auth::id())
            ->where('is_seen', false)
            ->count() ?: null;
    }

    public function mount()
    {
        $this->loadMerchants();
        $this->initLastMessageIds();
    }

    public function loadMerchants()
    {
        $adminId = Auth::id();

        $this->merchants = Merchant::whereHas('messages', function ($q) use ($adminId) {
            $q->where('receiver_id', $adminId)
                ->orWhere('sender_id', $adminId);
        })
            ->withCount([
                'messages as unread_count' => function ($q) use ($adminId) {
                    $q->where('receiver_id', $adminId)
                        ->where('is_seen', false);
                }
            ])
            ->with([
                'messages' => function ($q) use ($adminId) {
                    $q->where('receiver_id', $adminId)
                        ->orWhere('sender_id', $adminId)
                        ->latest()
                        ->limit(1);
                }
            ])
            ->get()
            ->sortByDesc(fn($merchant) => $merchant->latest_message?->created_at)
            ->map(function ($merchant) {
                $merchant->latest_message = $merchant->messages->first();
                return $merchant;
            });
    }


    protected function initLastMessageIds()
    {
        $userId = Auth::id();

        $lastMessages = Message::where(function ($q) use ($userId) {
            $q->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId);
        })
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy(fn($m) => $m->sender_id == $userId ? $m->receiver_id : $m->sender_id);

        foreach ($this->merchants as $merchant) {
            $this->lastMessageIdByMerchant[$merchant->id] =
                $lastMessages[$merchant->id]->first()->id ?? 0;
        }

        $this->lastTotalUnread = Message::where('receiver_id', $userId)
            ->where('is_seen', false)
            ->count();
    }

    public function selectMerchant($merchantId)
    {
        $this->selectedMerchantId = $merchantId;
        $this->selectedMerchant = Merchant::find($merchantId);

        Message::where('sender_id', $merchantId)
            ->where('receiver_id', Auth::id())
            ->where('is_seen', false)
            ->update(['is_seen' => true]);

        $this->updateMerchantUnread($merchantId, 0);

        $this->resetPage();
        $this->dispatch('scrollToBottom');

        $last = Message::where(function ($q) use ($merchantId) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $merchantId);
        })
            ->orWhere(function ($q) use ($merchantId) {
                $q->where('sender_id', $merchantId)->where('receiver_id', Auth::id());
            })
            ->orderBy('id', 'desc')
            ->first();

        $this->lastMessageIdByMerchant[$merchantId] = $last->id ?? 0;
    }

    public function getMessagesProperty()
    {
        if (!$this->selectedMerchantId) {
            return collect();
        }

        $userId = Auth::id();
        $merchantId = $this->selectedMerchantId;

        return Message::where(function ($q) use ($userId, $merchantId) {
            $q->where('sender_id', $userId)
                ->where('receiver_id', $merchantId);
        })
            ->orWhere(function ($q) use ($userId, $merchantId) {
                $q->where('sender_id', $merchantId)
                    ->where('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }


    public function sendMessage()
    {
        $text = trim($this->newMessage);
        if (!$text || !$this->selectedMerchantId) {
            return;
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'sender_type' => get_class(Auth::user()),
            'receiver_id' => $this->selectedMerchantId,
            'receiver_type' => Merchant::class,
            'content' => $text,
            'is_seen' => false,
        ]);

        $this->newMessage = '';
        $this->updateMerchantUnread($this->selectedMerchantId, 0);

        $this->lastMessageIdByMerchant[$this->selectedMerchantId] = $message->id;

        $this->dispatch('messageSent');
        $this->dispatch('scrollToBottom');
    }

    public function pollMessages()
    {
        $userId = Auth::id();

        $newMessages = Message::where('receiver_id', $userId)
            ->where('is_seen', false)
            ->orderBy('id', 'asc')
            ->get();

        if ($newMessages->isEmpty()) {
            return;
        }

        $grouped = $newMessages->groupBy('sender_id');

        foreach ($grouped as $senderId => $messagesFromSender) {
            if ($this->selectedMerchantId != $senderId) {
                $this->updateMerchantUnread($senderId, $messagesFromSender->count());

                $lastMessage = $messagesFromSender->last();
                $title = 'رسالة جديدة';
                $body = 'لديك رسالة جديدة من ' . ($lastMessage->sender_type === Merchant::class ? optional(Merchant::find($senderId))->name : 'تاجر');

                $this->dispatch('newMessageAlert', ['title' => $title, 'body' => $body, 'sender_id' => $senderId]);
            } else {
                Message::whereIn('id', $messagesFromSender->pluck('id')->toArray())
                    ->update(['is_seen' => true]);

                $this->updateMerchantUnread($senderId, 0);
            }

            $this->lastMessageIdByMerchant[$senderId] = $messagesFromSender->last()->id ?? 0;
        }

        $this->lastTotalUnread = Message::where('receiver_id', $userId)->where('is_seen', false)->count();
    }

    private function updateMerchantUnread($merchantId, $count)
    {
        foreach ($this->merchants as $merchant) {
            if ($merchant->id == $merchantId) {
                $merchant->unread_count = $count;
                break;
            }
        }
    }

    public function refreshMerchants()
    {
        $this->loadMerchants();
        $this->initLastMessageIds();
    }
}
