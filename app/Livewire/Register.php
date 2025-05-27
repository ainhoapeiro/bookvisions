<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class Register extends Component
{
    use WithFileUploads;

    public $name, $last_name, $username, $email, $bio, $password, $password_confirmation, $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'bio' => 'required|string|max:1000',
        'password' => 'required|string|confirmed|min:8',
        'image' => 'required|image|max:1024',
    ];

    public function register()
    {
        $this->validate();

        if ($this->image) {
            $filename = $this->image->getClientOriginalName();
            $this->image->move(public_path('profile-image'), $filename);
            $profileImagePath = 'profile-image/' . $filename;

        } else {
            // Imagen por defecto si no se sube ninguna
            $profileImagePath = 'profile-image/default-user.png';
        }

        $user = User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'bio' => $this->bio,
            'profile_image' => $profileImagePath,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }

}
