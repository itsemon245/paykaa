<?php

namespace App\Http\Controllers;

use App\Data\UserData;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'kyc'=> $request->user()->kyc,
        ]);
    }

    public function updateAvatar(Request $request): JsonResponse
    {
        $request->validate([
            'avatar' => ['nullable', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
        ],[
            'avatar.max' => 'The avatar must be less than or equal to 2MB',
        ]);
        $file = $request->file('avatar');
        $name = $request->user()->uuid . '.' . $file->getClientOriginalExtension();
        if(Storage::disk('public')->exists('uploads/avatars/'.$name)) {
            Storage::disk('public')->delete('uploads/avatars/'.$name);
        }
        $path = $file->storeAs('uploads/avatars', $name, 'public');
        $request->user()->update(['avatar' => $path]);
        return response()->json(['success' => true]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
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
