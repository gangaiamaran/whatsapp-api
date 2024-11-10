<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Chatroom;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chatroom\ChatroomCreateRequest;
use App\Models\Chatroom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class ChatroomCreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ChatroomCreateRequest $request): JsonResponse
    {
        $chatroom = new Chatroom;
        $chatroom->fill($request->validated());
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('public/chatroom/icons', 'public');
            $chatroom->icon = $path;
        }
        $chatroom->save();

        return response()->json([
            'message' => 'Chatroom created successfully.',
        ], Response::HTTP_CREATED);
    }
}
