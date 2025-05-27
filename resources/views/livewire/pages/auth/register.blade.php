{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>

    {{-- Errores de validación clásicos --}}
    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Nombre') }}</label>
            <input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Contraseña') }}</label>
            <input id="password" class="block mt-1 w-full"
                   type="password"
                   name="password"
                   required autocomplete="new-password" />
        </div>

        <!-- Confirmar contraseña -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Confirmar contraseña') }}</label>
            <input id="password_confirmation" class="block mt-1 w-full"
                   type="password"
                   name="password_confirmation"
                   required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('¿Ya tienes cuenta?') }}
            </a>

            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 disabled:opacity-25 transition">
                {{ __('Registrarse') }}
            </button>
        </div>
    </form>
</x-guest-layout>
