@extends('layouts.app')

@section('content')
    {{-- 🔠 Título principal --}}
    <div class="bg-white py-6 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800">{{ __('Edit Profile') }}</h1>
        </div>
    </div>
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6 text-sm shadow">
            {{ session('status') }}
        </div>
    @endif

    {{-- 🧾 Contenido --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 🧑 Editar perfil --}}
            <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="name" class="block font-medium text-sm text-gray-700">Nombre</label>
                                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="last_name" class="block font-medium text-sm text-gray-700">Apellido</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="username" class="block font-medium text-sm text-gray-700">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username', auth()->user()->username) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="bio" class="block font-medium text-sm text-gray-700">Biografía</label>
                                <textarea name="bio" id="bio" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('bio', auth()->user()->bio) }}</textarea>
                            </div>

                            {{-- SELECCIÓN DE AVATAR --}}
                            <div>
                                <label class="block font-medium text-sm text-gray-700 mb-2">
                                    {{ __('Elige tu avatar') }}
                                </label>
                                <div class="flex flex-wrap gap-4">
                                    @for ($i = 1; $i <= 8; $i++)
                                        <label class="cursor-pointer">
                                            <input
                                                type="radio"
                                                name="profile_image"
                                                value="{{ "profile-image/avatar_$i.png" }}"
                                                class="hidden peer"
                                                {{ (old('profile_image', auth()->user()->profile_image) == "profile-image/avatar_$i.png") ? 'checked' : '' }}
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
                                @error('profile_image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- FIN AVATAR --}}

                            <div class="pt-4">
                                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            {{-- 🔐 Cambiar contraseña --}}
            <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="current_password" class="block font-medium text-sm text-gray-700">Contraseña actual</label>
                                <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="password" class="block font-medium text-sm text-gray-700">Nueva contraseña</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmar contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                                    Cambiar contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            {{-- 🗑️ Eliminar cuenta --}}
            <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <div class="grid grid-cols-1 gap-4">
                            <p class="text-gray-700">Una vez eliminada, tu cuenta no podrá recuperarse. Escribe tu contraseña para confirmar:</p>

                            <div>
                                <label for="password" class="block font-medium text-sm text-gray-700">Contraseña</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="flex gap-4 pt-4">
                                <a href="{{ route('profile') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Cancelar</a>
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                    Eliminar cuenta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>
@endsection
