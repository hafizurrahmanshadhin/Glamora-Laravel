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
            })
                ->orWhere(function ($query) use ($senderId, $receiverId) {
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
     * Send a new message (with optional multiple attachments).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendMessage(Request $request): JsonResponse {
        try {
            $validated = $request->validate([
                'message'       => 'nullable|string',
                'receiver_id'   => 'required|exists:users,id',
                // Validate multiple files, each up to 30 MB
                'attachments.*' => 'nullable|file|max:30720',
            ]);

            $message              = new Message();
            $message->sender_id   = Auth::id();
            $message->receiver_id = $validated['receiver_id'];
            // If no text, store empty string
            $message->message = $validated['message'] ?? '';

            $savedPaths = [];

            // Handle multiple uploaded files
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    if ($file->isValid()) {
                        // Use Helper::fileUpload to store under public/uploads/chat_attachments/
                        $path = Helper::fileUpload($file, 'chat_attachments', null);
                        if ($path) {
                            // e.g. 'uploads/chat_attachments/abcd1234_1685808589.pdf'
                            $savedPaths[] = $path;
                        }
                    }
                }
            }

            // Only assign if we have at least one
            if (count($savedPaths) > 0) {
                $message->attachments = $savedPaths;
            }

            $message->save();
            $message->load('sender');

            // Broadcast it
            broadcast(new MessageSendEvent($message))->toOthers();

            // Build avatar URL
            $avatar = $message->sender->avatar
            ? asset($message->sender->avatar)
            : asset('backend/images/default_images/user_1.jpg');

            // Build public URLs for each attachment
            $publicAttachmentUrls = [];
            if (!empty($message->attachments)) {
                foreach ($message->attachments as $relativePath) {
                    $publicAttachmentUrls[] = asset($relativePath);
                }
            }

            return response()->json([
                'id'          => $message->id,
                'message'     => $message->message,
                'attachments' => $publicAttachmentUrls, // array of URLs
                'created_at'  => $message->created_at->format('h:i A'),
                'sender'      => [
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
