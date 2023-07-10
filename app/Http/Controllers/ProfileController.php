<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function show()
    {
        return view('profiles/create');
    }

    
    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'profile_name' => 'required|string|max:35',
            'profile_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'pan_card_number' => 'required|unique:profiles|regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/',
            'aadhar_card_number' => 'required|unique:profiles|digits:12',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store the form data in the database
        $profile = new Profile();
        $profile->profile_name = $request->input('profile_name');
        // Handle file upload for profile image
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('images'), $imageName);
            $profile->profile_image = $imageName;
        }
        $profile->email = $request->input('email');
        $profile->address = $request->input('address');
        $profile->pan_card_number = $request->input('pan_card_number');
        $profile->aadhar_card_number = $request->input('aadhar_card_number');
        $profile->save();

        // Redirect or perform any other desired action
        return redirect()->back()->with('success', 'Profile created successfully!');
    }

    // Other functions in the ProfileController
}


