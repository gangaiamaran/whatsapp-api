<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Chatroom;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class ChatroomLeaveController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $chatroomId): Response
    {
        $chatroom = Chatroom::query()->findOrFail($chatroomId);

        $chatroomUser = ChatroomUser::query()
            ->where('chatroom_id', $chatroomId)
            ->where('user_id', auth()->id())
            ->exists();

        abort_unless($chatroomUser, Response::HTTP_NOT_FOUND, 'Chatroom user not found.');

        $chatroom->users()->detach(auth()->id());

        return response()->noContent();
    }
}
