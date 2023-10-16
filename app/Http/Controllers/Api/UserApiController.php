<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\ApiUserResource;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\UserRegistrationRequest;

class UserApiController extends Controller
{
    public function register(UserRegistrationRequest $request) {
        $credentials = $request->only('email', 'password');
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json([
            'success' => true,
            'user' => $user,
        ], 200)
            ->withHeaders([
                'token' => JWTAuth::attempt($credentials),
        ]);
    }

    public function authentication(UserLoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $data = [
                'success' => true,
                'user' => $user,
                'message' => 'user login success',
                'popup' =>false,
            ];

            // Login Successful
            return response()->json($data, 200)
                ->withHeaders([
                    'token' => JWTAuth::attempt($credentials),
                ]);
        }

        return response()->json([
            'success' => false,
            'errors' => ['Email or Password Mismatch'],
        ], 401);
    }

    public function loadUser(Request $request)
    {
        $token = $request->bearerToken() ?? [];
        $user = JWTAuth::toUser($token);

        return response()->json([
            'success' => true,
            'user' => new ApiUserResource($user),
        ], 200);
    }

    public function jwtLogout(Request $request) {
        $token = $request->bearerToken() ?? [];
        try {
            JWTAuth::setToken($token)->invalidate(true);

            return response()->json([
              'success' => true,
              'message' => 'user logout success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
              'success' => false,
              'message' => $e->getMessage(),
            ], 401);
        }

    }

    public function refreshToken(Request $request) {
        $token = $request->bearerToken() ?? [];
        try {
            $token = JWTAuth::setToken($token)->refresh();

            return response()->json([
              'success' => true,
                'token' => $token,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
              'success' => false,
              'message' => $e->getMessage(),
            ], 401);
        }
    }

    public function forgotPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'Account not found, try another email.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'User requested reset password sent successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => [
                    'Sending password recovering link email failed',
                ],
            ]);
        }
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $data = [
                'success' => true,
                'message' => 'password has been successfully recovered.',
            ];
            $user = User::where('email', $request->email)->first();

            return response()->json($data, 200)
                ->withHeaders([
                        'token' => JWTAuth::attempt(['email' => $user->email, 'password' => $request->password]),
                    ]
                );
        }

        return response()->json([
            'success' => false,
            'errors' => [
                'password recovery failed',
            ],
        ]);
    }
}
