<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        $view = match ($user->role) {
            'admin' => 'profile.edit-admin',
            'patient' => 'patient.profile-settings',
            default => 'profile.edit',
        };

        return view($view, [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information (same flow for admin, patient, and other roles).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('patients', 'public');
        }

        if (! empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        unset(
            $validated['password'],
            $validated['password_confirmation'],
            $validated['image'],
            $validated['date_of_birth'],
            $validated['city'],
            $validated['country']
        );

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($user->role === 'patient') {
            $nameParts = preg_split('/\s+/', trim((string) $user->name), 2);

            Patient::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'first_name' => $nameParts[0] ?? $user->name,
                    'last_name' => $nameParts[1] ?? 'Patient',
                    'phone' => $user->mobile,
                    'date_of_birth' => $request->input('date_of_birth'),
                    'city' => $request->input('city'),
                    'country' => $request->input('country'),
                    'image' => $imagePath ?: $user->patient?->image,
                ]
            );
        }

        return Redirect::route('profile.edit')->with('success', __('Profile updated successfully.'));
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
