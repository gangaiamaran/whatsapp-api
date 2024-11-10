<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Chatroom;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatroomResource;
use App\Models\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ChatroomIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $chatrooms = Chatroom::query()
//            ->whereRelation('users', 'user_id', auth()->id())
            ->simplePaginate(20);

        return ChatroomResource::collection($chatrooms);
    }
}
