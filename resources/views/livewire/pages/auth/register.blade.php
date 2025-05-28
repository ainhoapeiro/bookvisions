<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'last_name' => '',
    'username' => '',
    'email' => '',
    'bio' => '',
    'password' => '',
    'password_confirmation' => '',
    'profile_image' => '', // El usuario tiene que elegir sí o sí
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'last_name' => ['required', 'string', 'max:255'],
    'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    'bio' => ['required', 'string', 'max:1000'],
    'profile_image' => ['required', 'string'],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('First Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Bio -->
        <div class="mt-4">
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea wire:model="bio" id="bio" name="bio" class="block mt-1 w-full rounded-md"></textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Avatar Selection -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Elige tu avatar') }}
            </label>
            <div class="flex flex-wrap gap-4">
                @for ($i = 1; $i <= 8; $i++)
                    <label class="cursor-pointer">
                        <input
                            type="radio"
                            wire:model="profile_image"
                            name="profile_image"
                            value="{{ "profile-image/avatar_$i.png" }}"
                            class="hidden peer"
                            required
                        >
                        <img
                            src="{{ asset("profile-image/avatar_$i.png") }}"
                            alt="Avatar {{ $i }}"
                            class="w-16 h-16 rounded-full border-2 border-transparent peer-checked:border-purple-500 hover:border-gray-300 transition"
                        >
                    </label>
                @endfor
            </div>
            <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4" style="background-color: rgba(143, 107, 170, 1); border-color: rgba(143, 107, 170, 1);">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
