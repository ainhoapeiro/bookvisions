@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8 space-y-10">

        {{-- 🧑 Perfil --}}
        <div class="bg-white p-6 rounded-xl shadow text-center">
            {{-- Imagen de perfil --}}
            @if ($user->profile_image)
                <img src="{{ asset('profile-image/' . $user->profile_image) }}"
                     alt="{{ $user->name }}"
                     class="w-32 h-32 rounded-full object-cover mx-auto mb-4 border-4 border-purple-300 shadow">
            @else
                <div class="w-32 h-32 rounded-full bg-gray-300 mx-auto mb-4"></div>
            @endif

            {{-- Nombre y bio --}}
            <h1 class="text-3xl font-bold">{{ $user->name }}</h1>

            <p class="mt-2 text-gray-600">
                {{ $user->bio ?? 'Este usuario aún no ha escrito su biografía.' }}
            </p>

            {{-- Número de seguidores y botón seguir --}}
            <div class="mt-4 flex items-center justify-center gap-4">
                <span class="text-gray-700 text-sm">
                    {{ $user->followers->count() }} seguidores
                </span>
                @auth
                    @if (auth()->id() !== $user->id)
                        <form action="{{ route('user.follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 text-sm rounded-lg text-white transition"
                                    style="background-color: #442b68;">
                                {{ auth()->user()->following->contains($user->id) ? 'Dejar de seguir' : 'Seguir' }}
                            </button>
                        </form>
                    @endif
                @endauth
            </div>

        </div>

        {{-- 🎨 Ilustraciones --}}
        <div class="bg-white p-6 rounded-xl mt-6 shadow">
            <h2 class="text-2xl font-semibold mb-6 text-purple-800">Ilustraciones de {{ $user->name }}</h2>

            @if($user->illustrations->isEmpty())
                <p class="text-gray-500 italic">Este usuario aún no ha publicado ilustraciones.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                    @foreach ($user->illustrations as $illustration)
                        <a href="{{ route('illustration.show', $illustration->id) }}" class="block group">
                            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow hover:shadow-lg transition duration-200 h-full w-[220px] flex flex-col">
                                <div class="aspect-[4/3] overflow-hidden">
                                    <img src="{{ asset('illustration/' . $illustration->image_path) }}"
                                         alt="{{ $illustration->title }}"
                                         class="w-[220px] object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-4 flex-grow flex flex-col justify-between">
                                    <h3 class="text-base font-bold text-gray-800 mb-1">{{ $illustration->title }}</h3>
                                    <p class="text-sm text-gray-500">Libro: {{ $illustration->book->title }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- 📚 Colecciones (solo si eres tú) --}}
        @auth
            @if(auth()->id() === $user->id)
                <div class="bg-white p-6 mt-6 rounded-xl shadow">
                    <h2 class="text-2xl font-semibold mb-4 text-purple-800">Tus colecciones</h2>

                    @if($user->collections->isEmpty())
                        <p class="text-gray-500 italic">Aún no has creado ninguna colección.</p>
                    @else
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($user->collections as $collection)
                                <a href="{{ route('collections.show', $collection->id) }}" class="block group">
                                    <div class="border rounded-xl shadow hover:shadow-md transition bg-white p-4 h-full">
                                        <h3 class="text-lg font-bold text-purple-700 mb-1 group-hover:underline">{{ $collection->title }}</h3>
                                        <p class="text-sm text-gray-600">{{ $collection->description ?? 'Sin descripción' }}</p>
                                        <p class="text-xs text-gray-400 mt-2">{{ $collection->illustrations->count() }} ilustraciones</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        @endauth

    </div>
@endsection
