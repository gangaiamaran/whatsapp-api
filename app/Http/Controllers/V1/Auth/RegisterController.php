<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = new User;
        $user->fill($request->validated());
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('public/users/profile_images', 'public');
            $user->profile_image = $path;
        }
        $user->save();

        $accessToken = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'User successfully registered',
            'access_token' => $accessToken,
        ], Response::HTTP_CREATED);
    }
}
