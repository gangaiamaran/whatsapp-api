<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        abort_unless($request->otp === '1234', 422, 'Invalid OTP');

        $user = User::query()
            ->where('mobile', $request->mobile)
            ->firstOrFail();

        $accessToken = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login successfully',
            'access_token' => $accessToken,
        ], Response::HTTP_OK);
    }
}
