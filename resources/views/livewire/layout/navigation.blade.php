<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-12 w-18 fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links alineados a la derecha -->
            <div class="hidden sm:flex items-center ms-auto space-x-8">
                {{-- Enlace a Inicio (público) --}}
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate
                            class="text-black-800 hover:underline underline-offset-4">
                    {{ __('Inicio') }}
                </x-nav-link>

                {{-- Enlace a Explorar (público) --}}
                <x-nav-link :href="route('explore')" :active="request()->routeIs('explore')" wire:navigate
                            class="text-black-800 hover:underline underline-offset-4">
                    {{ __('Explorar') }}
                </x-nav-link>

                @guest
                    <a href="{{ route('login') }}"
                       class="text-white font-semibold px-4 py-2 rounded-xl shadow hover:opacity-90 transition duration-200"
                       style="background-color: #8f6baa;">
                        Iniciar sesión
                    </a>
                @endguest

                @auth
                    <div x-data="{ openAvatarMenu: false }" class="relative">
                        <button @click="openAvatarMenu = !openAvatarMenu"
                                class="flex items-center focus:outline-none"
                                id="avatar-button">
                            <img src="{{ asset(auth()->user()->profile_image) }}"
                                 alt="Avatar"
                                 class="w-8 h-8 rounded-full object-cover ring-2 ring-purple-500">
                        </button>

                        <!-- Menú -->
                        <div x-show="openAvatarMenu"
                             @click.away="openAvatarMenu = false"
                             x-transition
                             class="absolute right-0 mt-2 w-48 bg-white border rounded-xl shadow-lg z-50">
                            <a href="{{ route('profile.view', auth()->id()) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">👤 Mi perfil</a>

                            <a href="{{ route('illustrations.create') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">🖼️ Subir ilustración</a>

                            <a href="{{ route('profile') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">⚙️ Modificar perfil</a>

                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.panel') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">📊 Panel de Administración</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}" class="border-t mt-1">
                                @csrf
                                <button type="submit"
                                        class="w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    🚪 Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                Inicio
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('explore')" :active="request()->routeIs('explore')" wire:navigate>
                Explorar
            </x-responsive-nav-link>

            @guest
                <div class="px-2 py-3 border-t border-gray-200">
                    <a href="{{ route('login') }}"
                       class="block w-full text-center font-semibold text-white rounded-xl py-2 transition"
                       style="background-color: #8f6baa;">
                        Iniciar sesión
                    </a>
                </div>
            @endguest

        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4 flex items-center gap-4">
                    <img src="{{ asset( auth()->user()->profile_image) }}"
                         alt="Avatar"
                         class="w-10 h-10 rounded-full object-cover ring-2 ring-purple-500">
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1 px-4">
                    <a href="{{ route('profile.view', auth()->id()) }}"
                       class="block text-sm text-gray-700 hover:underline">👤 Mi perfil</a>

                    <a href="{{ route('illustrations.create') }}"
                       class="block text-sm text-gray-700 hover:underline">🖼️ Subir ilustración</a>

                    <a href="{{ route('profile') }}"
                       class="block text-sm text-gray-700 hover:underline">⚙️ Modificar perfil</a>

                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.panel') }}"
                           class="block text-sm text-gray-700 hover:underline">📊 Panel de Administración</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit"
                                class="block text-sm text-gray-700 hover:underline w-full text-start">
                            🚪 Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
