<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function show()
    {
        $user = Auth::user();
        return view('profil.show', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::find($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle the profile picture upload
    if ($request->hasFile('profile_picture')) {
        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->move(public_path('uploads/profile_pictures'), $fileName);
        $user->profile_picture = 'uploads/profile_pictures/' . $fileName;
    }

    // Update the user's name
    $user->name = $request->name;
    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
}
}
