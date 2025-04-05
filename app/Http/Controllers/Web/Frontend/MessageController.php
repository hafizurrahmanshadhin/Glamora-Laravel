<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Events\MessageSendEvent;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller {
    /**
     * Show the chat page.
     *
     * @param int $id
     * @return JsonResponse|View
     */
    public function show(int $id): JsonResponse | View {
        try {
            $receiver   = User::findOrFail($id);
            $senderId   = Auth::id();
            $receiverId = $id;

            $messages = Message::where(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $senderId)
                    ->where('receiver_id', $receiverId);
            })->orWhere(function ($query) use ($senderId, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $senderId);
            })
                ->with('sender:id,first_name,last_name,avatar', 'receiver:id,first_name,last_name,avatar')
                ->get();

            return view('frontend.layouts.chat.index', [
                'receiver' => $receiver,
                'messages' => $messages,
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Send a new message.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendMessage(Request $request): JsonResponse {
        try {
            $validated = $request->validate([
                'message'     => 'required',
                'receiver_id' => 'required|exists:users,id',
            ]);

            $message              = new Message();
            $message->sender_id   = Auth::id();
            $message->receiver_id = $validated['receiver_id'];
            $message->message     = $validated['message'];
            $message->save();

            // Broadcast to the receiver’s channel
            broadcast(new MessageSendEvent($message))->toOthers();

            // Construct a public URL for the sender’s avatar
            $avatar = $message->sender->avatar
            ? asset($message->sender->avatar)
            : asset('backend/images/default_images/user_1.jpg');

            return response()->json([
                'id'         => $message->id,
                'message'    => $message->message,
                // 'created_at' => $message->created_at->format('H:i'),
                // Use 12-hour format with AM/PM
                'created_at' => $message->created_at->format('h:i A'),
                'sender'     => [
                    'id'         => $message->sender->id,
                    'first_name' => $message->sender->first_name,
                    'avatar'     => $avatar,
                ],
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
