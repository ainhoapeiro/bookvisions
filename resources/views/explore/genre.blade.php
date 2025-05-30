@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-[2em] md:text-[2.3em] text-center font-['Noto Sans Mono'] font-bold mb-6" style="color: #442b68">{{ $gender->name }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">
            @foreach ($gender->books as $book)
                <a href="{{ route('book.show', $book->id) }}">
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition text-center">

                        {{-- Imagen principal del libro --}}
                        @if($book->image)
                            <div class="flex justify-center mb-3">
                                <img src="{{ asset('books/' . $book->image) }}"
                                     alt="{{ $book->title }}"
                                     class="w-32 h-42 object-cover rounded">
                            </div>
                        @endif

                        {{-- Título y autor --}}
                        <h2 class="text-[1.2em] md:text-[1.5em] font-semibold font-['Noto Sans Mono']">{{ $book->title }}</h2>
                        <h3 class="text-[0.95em] md:text-[1.1em] text-gray-700 font-medium font-['Noto Sans Mono']">{{ $book->author }}</h3>

                        {{-- Miniaturas de ilustraciones --}}
                        @if($book->illustrations && $book->illustrations->count())
                            <div class="flex justify-center gap-2 mt-3 flex-wrap">
                                @foreach ($book->illustrations->take(3) as $illustration)
                                    <div class="w-20 h-20 overflow-hidden rounded border border-gray-300">
                                        <img src="{{ asset($illustration->image_path) }}"
                                             alt="Illustration"
                                             class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
