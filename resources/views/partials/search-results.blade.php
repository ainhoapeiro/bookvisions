<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse ($books as $book)
        <a href="{{ route('book.show', $book->id) }}">
            <div class="bg-white border rounded-xl shadow hover:shadow-md transition p-4 flex flex-col items-center text-center">
                @if($book->image)
                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="w-32 h-42 object-cover rounded mb-4">
                @endif
                <h2 class="text-lg font-semibold font-['Noto Sans Mono']">{{ $book->title }}</h2>
                <h3 class="text-sm text-gray-700 font-medium font-['Noto Sans Mono']">{{ $book->author }}</h3>
            </div>
        </a>
    @empty
        <p class="col-span-4 text-center text-gray-500">No se encontraron resultados.</p>
    @endforelse
</div>
