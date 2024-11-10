<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Messages;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class MessageIndexController extends Controller
{
    public function __invoke(Request $request, string $chatroomId): AnonymousResourceCollection
    {
        $messages = Message::query()
            ->with('attachments:id,message_id,path')
            ->where('chatroom_id', $chatroomId)
            ->simplePaginate();

        return MessageResource::collection($messages);
    }
}
