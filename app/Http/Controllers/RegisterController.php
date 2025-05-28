<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register'); // Asegúrate de que la ruta de la vista es correcta
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'bio' => 'required|string|max:1000',
            'password' => 'required|string|confirmed|min:8',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid('user_') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile-image'), $filename);
            $profileImage = 'profile-image/' . $filename;
        } else {
            $profileImage = 'profile-image/default-user.png';
        }

        $user = User::create([
            'name' => $validated['name'],
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'bio' => $validated['bio'],
            'profile_image' => $profileImage,
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('profile'); // Cambia por la ruta de tu dashboard si es diferente
    }
}
