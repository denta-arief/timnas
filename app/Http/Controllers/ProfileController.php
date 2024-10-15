<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Jika ada file gambar yang di-upload
        if ($request->hasFile('profile_picture')) {
            // Dapatkan file gambar
            $file = $request->file('profile_picture');
            
            // Hapus gambar lama jika ada
            if ($user->profile_picture && Storage::exists($user->profile_picture)) {
                Storage::delete($user->profile_picture);
            }

            // Simpan file di folder 'public/profile_pictures'
            $path = $file->store('profile_pictures', 'public'); // simpan di storage/app/public/profile_pictures

            // Update path gambar di database (tanpa prefix 'public/')
            $user->profile_picture = $path;
        }

        // Update nama pengguna
        $user->name = $request->input('name');
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}