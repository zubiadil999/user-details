<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function dashboard()
    {
        $profiles = Profile::all();
    
        return view('admin.dashboard', compact('profiles'));
    }
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
    
        return view('admin.edit', compact('profile'));
    }
    
   public function update(Request $request, $id)
{
    $rules = [
        'profile_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'nullable|string|max:255',
        'pan_card_number' => 'required|regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/',
        'aadhar_card_number' => 'required|digits:12',
    ];

    if ($request->hasFile('profile_image')) {
        $rules['profile_image'] = 'image';
    }

    $validatedData = $request->validate($rules);

    $profile = Profile::findOrFail($id);

    if ($request->hasFile('profile_image')) {
        // Delete old image file if it exists
        if ($profile->profile_image) {
            // Remove the old image file from the public disk
            Storage::disk('public')->delete('images/' . $profile->profile_image);
        }

        // Store the new image file
        $imagePath = $request->file('profile_image')->store('public/images');
        $validatedData['profile_image'] = basename($imagePath);
    }

    $profile->update($validatedData);

    return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
}

    
    public function delete($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
    
        return redirect()->back()->with('success', 'Profile deleted successfully!');
    }
}
