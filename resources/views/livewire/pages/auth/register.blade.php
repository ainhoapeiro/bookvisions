@extends('layouts.app')

@section('content')

    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nombre -->
        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" required>
            @error('name') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Apellidos -->
        <div>
            <label for="last_name">Apellidos</label>
            <input type="text" name="last_name" id="last_name" required>
            @error('last_name') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Username -->
        <div>
            <label for="username">Usuario</label>
            <input type="text" name="username" id="username" required>
            @error('username') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Bio -->
        <div>
            <label for="bio">Biografía</label>
            <textarea name="bio" id="bio" required></textarea>
            @error('bio') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            @error('email') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Imagen de perfil -->
        <div>
            <label for="image">Imagen de perfil (opcional)</label>
            <input type="file" name="image" id="image" accept="image/*">
            @error('image') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
            @error('password') <span>{{ $message }}</span> @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div>
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            @error('password_confirmation') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit">Registrarse</button>
    </form>

@endsection
