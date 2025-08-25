<x-filament::page>
    <div class="flex h-screen bg-white dark:bg-gray-900 rounded-lg overflow-hidden shadow-lg border dark:border-gray-700">
        <aside class="w-1/4 bg-gray-50 dark:bg-gray-800 border-r dark:border-gray-700 overflow-y-auto" style="min-width: 250px;">
            <h2 class="text-lg font-bold p-4 border-b bg-white dark:bg-gray-900 dark:text-gray-200">Merchants</h2>

            @forelse ($this->merchants as $merchant)
            <div wire:click="selectMerchant({{ $merchant->id }})"
                class="p-4 cursor-pointer flex justify-between items-center transition-all duration-200 hover:bg-primary-100 dark:hover:bg-primary-800 {{ $this->selectedMerchantId === $merchant->id ? 'bg-primary-600 dark:bg-primary-700 font-semibold text-white' : 'text-gray-800 dark:text-gray-200' }}">
                <div class="flex-1 min-w-0">
                    <div class="truncate font-medium">{{ $merchant->name }}</div>
                    @if($merchant->latest_message)
                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate">
                        {{ \Illuminate\Support\Str::limit($merchant->latest_message->content, 60) }}
                    </div>
                    @endif
                </div>
                @if($merchant->unread_count > 0)
                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                    {{ $merchant->unread_count }}
                </span>
                @endif
            </div>
            @empty
            <p class="p-4 text-sm text-gray-500 dark:text-gray-400">No merchants found</p>
            @endforelse
        </aside>

        <section class="flex-1 flex flex-col justify-between {{ $this->selectedMerchant ? 'bg-gray-100 dark:bg-gray-950' : 'bg-white dark:bg-gray-900' }}">
            @if ($this->selectedMerchant)
            <div class="px-6 py-4 bg-primary-100 dark:bg-primary-800 border-b dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                    Contact with : {{ $this->selectedMerchant->name }}
                </h2>
            </div>
            @endif

            <div class="flex-1 overflow-y-auto p-6 space-y-4" x-ref="chatBox" wire:poll.5s="pollMessages">
                @if ($this->selectedMerchant)
                @forelse ($this->messages as $message)
                <div class="flex {{ $message->sender_type === \App\Models\User::class ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[50%] px-4 py-2 rounded-lg shadow-sm break-words {{ $message->sender_type === \App\Models\User::class ? 'bg-primary-600 text-white rounded-br-none' : 'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200 rounded-bl-none border dark:border-gray-700' }}">
                        <div class="text-sm leading-relaxed">{{ $message->content }}</div>
                        <div class="text-xs mt-1 text-right opacity-70 dark:text-gray-400">
                            {{ $message->created_at->isToday() ? $message->created_at->format('H:i') : $message->created_at->format('d/m H:i') }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-400 dark:text-gray-500">No Message</p>
                @endforelse
                @else
                <div class="flex items-center justify-center h-full text-gray-400 dark:text-gray-500 text-lg">
                    Choose a merchant to start chatting
                </div>
                @endif
            </div>

            @if ($this->selectedMerchant)
            
            <form wire:submit.prevent="sendMessage" class="p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700 flex gap-2">
                <input wire:model.defer="newMessage" wire:keydown.enter="sendMessage" type="text"
                    class="flex-1 border dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                    placeholder="Write your message..." />
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2 rounded-lg transition-all" style="width:75px;">
                    Send
                </button>
            </form>
            @endif
        </section>

    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            const scrollChat = (delay = 100) => {
                let chatBox = document.querySelector('[x-ref=chatBox]');
                if (chatBox) {
                    setTimeout(() => {
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }, delay);
                }
            };

            const playNotificationSound = () => {
                const audio = new Audio('/sounds/notify.wav');
                audio.play().catch(() => {});
            };

            window.addEventListener('newMessageAlert', event => {
                if (window.filament && window.filament.notifications) {
                    window.filament.notifications.notify({
                        title: event.detail.title,
                        body: event.detail.body,
                        status: 'info',
                    });
                }
                playNotificationSound();
                scrollChat(150);
            });

            window.addEventListener('messageSent', () => scrollChat(120));
            window.addEventListener('scrollToBottom', () => scrollChat(150));
            scrollChat(250);
        });
    </script>
</x-filament::page>