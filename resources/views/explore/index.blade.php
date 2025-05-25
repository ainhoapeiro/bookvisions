@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- 🔍 Buscador --}}
        <div class="mb-10">
            <input type="text" id="search-input" placeholder="Search for books..."
                   class="w-full p-4 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div id="results-container" class="mt-5">
            @foreach ($genders as $gender)
                <div class="relative group p-6 rounded-xl mb-5 hover:shadow-lg transition" style="background-color: #442b68;">
                    <a href="{{ route('genre.show', $gender->id) }}" class="block pt-3">
                        <h1 class="text-[2em] md:text-[2.3em] text-white font-extrabold text-center font-['Noto Sans Mono'] group-hover:underline">
                            {{ $gender->name }}
                        </h1>
                    </a>
                    <div class="grid grid-cols-2 gap-6 pt-6">
                        @foreach ($gender->books->take(4) as $book)
                            <a href="{{ route('book.show', $book->id) }}">
                                <div class="bg-white border rounded-xl shadow hover:shadow-md transition p-4 flex flex-col items-center justify-between text-center min-h-[300px]">
                                    @if($book->image)
                                        <img src="{{ asset('books/' . $book->image) }}"
                                             alt="{{ $book->title }} cover"
                                             class="w-32 h-42 object-cover rounded mb-4">
                                    @endif
                                        <h2 class="text-[1.2em] md:text-[1.5em] font-semibold font-['Noto Sans Mono']">{{ $book->title }}</h2>
                                        <h3 class="text-[0.95em] md:text-[1.1em] text-gray-700 font-medium font-['Noto Sans Mono']">{{ $book->author }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Script AJAX --}}
        <script>
            document.getElementById('search-input').addEventListener('input', function () {
                const query = this.value;

                fetch(`/explore/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('results-container').innerHTML = html;
                    });
            });
        </script>

    </div>
@endsection
