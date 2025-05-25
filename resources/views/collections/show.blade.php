@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-10 space-y-8">

        {{-- 🗂️ Cabecera --}}
        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h1 class="text-3xl font-bold text-purple-800">{{ $collection->title }}</h1>
            <p class="mt-2 text-gray-600">{{ $collection->description ?? 'Sin descripción.' }}</p>
            <p class="text-sm text-gray-400 mt-1">Creada por <span class="font-semibold">{{ $collection->user->name }}</span></p>
        </div>

        {{-- 🎨 Ilustraciones --}}
        <div class="bg-white p-6 rounded-xl shadow mt-6">
            <h2 class="text-2xl font-semibold mb-6 text-purple-800">Ilustraciones guardadas</h2>

            @if($collection->illustrations->isEmpty())
                <p class="text-gray-500 italic text-center">No hay ilustraciones en esta colección.</p>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 gap-6 mt-6">
                    @foreach ($collection->illustrations as $illustration)
                        <a href="{{ route('illustrations.show', $illustration->id) }}" class="block group">
                            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow hover:shadow-lg transition duration-200 h-full w-[220px] flex flex-col">
                                <div class="aspect-[4/3] overflow-hidden">
                                    <img src="{{ asset('illustrations/' . $illustration->image_path) }}"
                                         alt="{{ $illustration->title }}"
                                         class="w-[220px] h-full object-cover group-hover:scale-105 transition-transform duration-300">
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
        <a href="{{ route('profile.view', $collection->user->id) }}"
           class="inline-block mt-4 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium">
            ← Volver al perfil de {{ $collection->user->name }}
        </a>
    </div>
@endsection
