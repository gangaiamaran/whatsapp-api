<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Chatroom;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

final class ChatroomEnterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $chatroomId): JsonResponse
    {
        $chatroom = Chatroom::query()->findOrFail($chatroomId);

        $chatroomUsersCount = ChatroomUser::query()
            ->where('chatroom_id', $chatroom->id)
            ->count();

        abort_if($chatroomUsersCount < config('services.chatroom.max_users'), Response::HTTP_BAD_REQUEST, 'Duplicate chatroom entry');

        $chatroomUser = ChatroomUser::query()
            ->where('chatroom_id', $chatroom->id)
            ->where('user_id', auth()->id())
            ->exists();

        abort_if($chatroomUser, Response::HTTP_BAD_REQUEST, 'Chatroom reached max users limit');

        $chatroom->users()->attach(auth()->id(), ['id' => Str::uuid()->toString()]);

        return response()->json([
            'message' => 'Chatroom entered successfully',
        ]);
    }
}
