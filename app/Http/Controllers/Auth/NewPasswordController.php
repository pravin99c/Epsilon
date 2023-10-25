<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withError('email address not found');
        }


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // Password reset successful
            return redirect()->route('login')->with('message', 'Change Password successfully');
        } else {
            // Password reset failed
            return redirect()->back()->withError('error', 'Some things went wrong');
        }
    }
}
