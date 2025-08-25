<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|integer',
        ]);

        $sender = auth()->user();
        $senderType = get_class($sender);
        $receiverType = $senderType === 'App\Models\Merchant'
            ? 'App\Models\User'
            : 'App\Models\Merchant';

        $message = Message::create([
            'sender_id' => $sender->id,
            'sender_type' => $senderType,
            'receiver_id' => $request->receiver_id,
            'receiver_type' => $receiverType,
            'content' => $request->message,
            'is_seen' => false,
        ]);

        return response()->json(['message' => 'تم إرسال الرسالة', 'data' => $message]);
    }

    public function getConversation(Request $request)
    {
        $request->validate([
            'other_id' => 'required|integer',
        ]);

        $user = auth()->user();
        $userType = get_class($user);
        $otherType = $userType === 'App\Models\Merchant' ? 'App\Models\User' : 'App\Models\Merchant';

        $messages = Message::where(function ($query) use ($user, $userType, $request, $otherType) {
            $query->where('sender_id', $user->id)
                ->where('sender_type', $userType)
                ->where('receiver_id', $request->other_id)
                ->where('receiver_type', $otherType);
        })->orWhere(function ($query) use ($user, $userType, $request, $otherType) {
            $query->where('sender_id', $request->other_id)
                ->where('sender_type', $otherType)
                ->where('receiver_id', $user->id)
                ->where('receiver_type', $userType);
        })->orderBy('created_at')->get();

        return response()->json(['messages' => $messages]);
    }
    
}
