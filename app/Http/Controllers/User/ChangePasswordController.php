<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index() {
        return view('users.change-password');
    }

    public function create(ChangePasswordRequest $request) {
        $user = User::where('id', auth()->user()->id)
            ->first();

        if(empty($user)) {
            return redirect()->back()->with('error', 'User not found');
        }

        if ($user && !Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'User password is incorrect');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('message', 'password changed successfully');
    }
}
