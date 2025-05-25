@extends('layouts.app')

@section('content')
        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

                    {{-- Portada --}}
                    @if($book->image)
                        <div class="flex justify-center">
                            <img src="{{ asset('books/' . $book->image) }}"
                                 alt="{{ $book->title }}"
                                 class="w-90 h-96 object-cover rounded">
                        </div>
                    @endif

                    {{-- Info del libro --}}
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $book->title }}</h1>
                        <p class="text-sm text-gray-600 mb-2">By {{ $book->author }}</p>

                        <span class="inline-block bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full mb-4">
                        {{ $book->gender->name }}
                    </span>

                        <p class="text-gray-700 leading-relaxed">{{ $book->synopsis }}</p>
                    </div>
                </div>
            </div>
        </div>

    {{-- Ilustraciones --}}
        <div class="bg-white p-6 rounded-xl shadow mt-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 font-['Noto Sans Mono']">
                Ilustraciones del libro
            </h2>

            @if ($book->illustrations->isEmpty())
                <p class="text-gray-500 text-center">Aún no hay ilustraciones asociadas a este libro.</p>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($book->illustrations as $illustration)
                        <a href="{{ route('illustration.show', $illustration->id) }}"
                           class="block w-full overflow-hidden">

                            <img src="{{ asset($illustration->image_path) }}"
                                 alt="{{ $illustration->title }}"
                                 class="w-full object-cover rounded">
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
@endsection
