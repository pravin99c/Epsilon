<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function overview(Request $request): View
    {
        return view('user.overview');
    }

    public function edit(Request $request): View
    {
        return view('user.edit');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $updateData = $request->only('first_name', 'last_name','phone_number','dob', 'gender');
        $user = User::where('id',auth()->user()->id)->first();
        $path = null;

        if(! empty($request->file('profile_picture'))) {
            // call helper function
            $path = uploadImage($request->file('profile_picture'));
            $updateData['profile_picture'] = $path;
        }

        // update profile details
        $user->update($updateData);
        return Redirect::route('users.profile.edit')->with('message', 'User profile updated successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
