<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Messages;

use App\Events\MessageSentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Messages\SendMessageRequest;
use App\Models\Message;
use App\Models\MessageAttachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

final class SendMessageController extends Controller
{
    public function __invoke(SendMessageRequest $request): JsonResponse
    {
        $message = new Message();
        $message->user_id = auth()->id();
        $message->chatroom_id = $request->get('chatroom_id');
        $message->content = $request->get('content');
        $message->save();

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $mimeType = $file->getMimeType();

                if (Str::startsWith($mimeType, 'video/')) {
                    $path = $file->store('video', 'public');
                }

                if (Str::startsWith($mimeType, 'image/')) {
                    $path = $file->store('picture', 'public');
                }

                MessageAttachment::create([
                    'message_id' => $message->id,
                    'path' => $path,
                ]);
            }
        }

        broadcast(new MessageSentEvent($message))->toOthers();

        return response()->json([
            'message' => 'Message sent successfully',
        ], Response::HTTP_CREATED);
    }
}
