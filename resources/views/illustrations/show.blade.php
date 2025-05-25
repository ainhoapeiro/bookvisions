@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-xl shadow relative">

            {{-- Imagen --}}
            <img src="{{ asset($illustration->image_path) }}"
                 alt="{{ $illustration->title }}"
                 class="w-[220px] h-auto object-contain rounded mb-6 mx-auto">

            {{-- Título y descripción --}}
            <h1 class="text-2xl font-bold mb-2 text-center">{{ $illustration->title }}</h1>
            <p class="text-gray-600 mb-6 text-center">{{ $illustration->description }}</p>

            <div class="mb-4 text-center text-sm text-gray-500">
                Ilustrado por
                <a href="/users/{{ $illustration->user->id }}" class="text-purple-600 hover:underline">
                    {{ $illustration->user->name }}
                </a>
                para el libro
                <a href="{{ route('book.show', $illustration->book->id) }}" class="text-purple-600 hover:underline">
                    {{ $illustration->book->title }}
                </a>
            </div>

            {{-- Likes, botones --}}
            <div class="flex items-center justify-between mb-6 px-4">
            <span class="text-gray-700 font-semibold text-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 1.01 4.5 2.09C13.09 4.01 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                {{ $illustration->likedByUsers->count() }} likes
            </span>

                @auth
                    <div class="flex items-center gap-4">
                        {{-- Like --}}
                        <form action="{{ route('illustration.like', $illustration->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 bg-purple-500 rounded hover:bg-purple-600" title="Like">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 1.01 4.5 2.09C13.09 4.01 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </button>
                        </form>

                        {{-- Comentar --}}
                        <button id="toggle-comment" class="p-2 bg-gray-200 rounded hover:bg-gray-300" title="Comentar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2h-8l-4 4V10a2 2 0 012-2h2"/>
                            </svg>
                        </button>

                        {{-- Guardar en colección --}}
                        <button type="button" class="p-2 bg-blue-200 rounded hover:bg-blue-300" title="Guardar en colección"
                                onclick="document.getElementById('modal-collection').classList.remove('hidden')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l9 6 9-6"/>
                            </svg>
                        </button>
                    </div>
                @else
                    <p class="text-sm text-center mt-4 text-gray-600 italic">
                        🛑 <a href="{{ route('login') }}" class="text-purple-600 hover:underline">
                            Inicia sesión
                        </a> para poder dar like, comentar o guardar esta ilustración en tus colecciones.
                    </p>

                @endauth
            </div>

            {{-- Comentarios --}}
            @auth
                <div id="comment-form" class="mb-6 hidden">
                    <form action="{{ route('illustration.comment', $illustration->id) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <input type="text" name="comment" placeholder="Escribe tu comentario aquí..." class="flex-grow p-2 border rounded" required>
                        <button type="submit" class="p-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @endauth

            <div>
                <h2 class="text-xl font-semibold mb-2">Comentarios</h2>
                @foreach ($illustration->comments as $comment)
                    <div class="mb-3">
                        <p class="text-sm text-gray-800 font-semibold">{{ $comment->user->name }}</p>
                        <p class="text-gray-600">{{ $comment->content }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Modal de colección --}}
    <div id="modal-collection" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4 text-center">Seleccionar o Crear Colección</h2>

            <form method="POST" action="{{ route('collections.save', $illustration->id) }}">
                @csrf

                {{-- Seleccionar colección existente --}}
                <label for="collectionSelect" class="block text-sm font-medium text-gray-700">Seleccionar colección</label>
                <select id="collectionSelect" name="collection" class="mt-1 mb-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    <option disabled selected>Selecciona una colección existente</option>
                    @foreach ($collections as $collection)
                        <option value="{{ $collection->id }}">{{ $collection->title }}</option>
                    @endforeach
                </select>

                {{-- Crear nueva colección --}}
                <label for="newCollection" class="block text-sm font-medium text-gray-700">Nuevo título de colección</label>
                <input type="text" id="newCollection" name="new_collection" placeholder="Escribe un título"
                       class="mt-1 mb-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">

                <label for="newDescription" class="block text-sm font-medium text-gray-700">Descripción (opcional)</label>
                <textarea id="newDescription" name="new_description" rows="2" placeholder="Describe brevemente tu colección"
                          class="mt-1 mb-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"></textarea>

                {{-- Botones --}}
                <div class="flex justify-between mt-4">
                    <button type="button"
                            onclick="document.getElementById('modal-collection').classList.add('hidden')"
                            class="px-4 py-2 bg-purple-300 text-purple-800 font-semibold rounded hover:bg-purple-400">
                        Cancelar
                    </button>

                    <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white font-semibold rounded hover:bg-purple-700">
                        Guardar en colección
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('toggle-comment').addEventListener('click', function () {
            const form = document.getElementById('comment-form');
            form.classList.toggle('hidden');
        });
    </script>
@endsection
