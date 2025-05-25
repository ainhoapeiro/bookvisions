@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12 text-center">
        <h1 class="text-4xl font-bold mb-4">Descubre BookVisions</h1>
        <p class="text-lg text-gray-600 mb-8">
            Una galería digital donde los libros cobran vida a través del arte. Explora ilustraciones únicas inspiradas en tus historias favoritas.
        </p>

        <a href="{{ route('explore') }}"
           class="inline-block text-white mt-6 font-medium px-6 py-3 rounded-lg hover:opacity-90 transition"
           style="background-color: #442b68;">
            Explorar
        </a>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-semibold mb-6 text-center">Selección destacada de libros</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
            @foreach ($books as $book)
                <a href="{{ route('book.show', $book) }}"
                   class="bg-white rounded-xl shadow-lg mt-6 hover:shadow-xl transition block overflow-hidden w-[220px]">

                    <div class="w-[220px] h-[220px]">
                        <img src="{{ asset('books/' . $book->image) }}"
                             alt="Portada de {{ $book->title }}"
                             class="w-[220px] h-[220px] object-cover">
                    </div>

                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-3 text-center">{{ $book->title }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <footer class="bg-gray-100 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 flex justify-center gap-6 items-center">
            <!-- Instagram -->
            <a href="https://instagram.com" target="_blank" aria-label="Instagram">
                <svg class="w-12 h-12" fill="#442b68" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.206.056 2.003.24 2.47.403a4.92 4.92 0 011.675 1.087 4.918 4.918 0 011.087 1.675c.163.467.347 1.264.403 2.47.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.056 1.206-.24 2.003-.403 2.47a4.918 4.918 0 01-1.087 1.675 4.918 4.918 0 01-1.675 1.087c-.467.163-1.264.347-2.47.403-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.206-.056-2.003-.24-2.47-.403a4.918 4.918 0 01-1.675-1.087 4.918 4.918 0 01-1.087-1.675c-.163-.467-.347-1.264-.403-2.47C2.175 15.747 2.163 15.367 2.163 12s.012-3.584.07-4.85c.056-1.206.24-2.003.403-2.47a4.918 4.918 0 011.087-1.675 4.918 4.918 0 011.675-1.087c.467-.163 1.264-.347 2.47-.403 1.266-.058 1.646-.07 4.85-.07zm0 1.838c-3.145 0-3.507.012-4.743.068-1.144.053-1.76.24-2.172.403a3.082 3.082 0 00-1.116.73 3.082 3.082 0 00-.73 1.116c-.163.412-.35 1.028-.403 2.172-.056 1.236-.068 1.598-.068 4.743s.012 3.507.068 4.743c.053 1.144.24 1.76.403 2.172.173.433.41.82.73 1.116.296.296.683.557 1.116.73.412.163 1.028.35 2.172.403 1.236.056 1.598.068 4.743.068s3.507-.012 4.743-.068c1.144-.053 1.76-.24 2.172-.403a3.082 3.082 0 001.116-.73 3.082 3.082 0 00.73-1.116c.163-.412.35-1.028.403-2.172.056-1.236.068-1.598.068-4.743s-.012-3.507-.068-4.743c-.053-1.144-.24-1.76-.403-2.172a3.082 3.082 0 00-.73-1.116 3.082 3.082 0 00-1.116-.73c-.412-.163-1.028-.35-2.172-.403-1.236-.056-1.598-.068-4.743-.068zm0 3.838a5.999 5.999 0 100 12 5.999 5.999 0 000-12zm0 9.9a3.9 3.9 0 110-7.8 3.9 3.9 0 010 7.8zm6.406-10.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                </svg>
            </a>

            <!-- Twitter -->
            <a href="https://twitter.com" target="_blank" aria-label="Twitter">
                <svg class="w-12 h-12" fill="#442b68" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24 4.557a9.83 9.83 0 01-2.828.775 4.932 4.932 0 002.165-2.724 9.864 9.864 0 01-3.127 1.195 4.916 4.916 0 00-8.384 4.482A13.94 13.94 0 011.671 3.149 4.918 4.918 0 003.195 9.72a4.902 4.902 0 01-2.228-.616c-.054 2.281 1.582 4.415 3.949 4.89a4.902 4.902 0 01-2.224.084 4.919 4.919 0 004.59 3.417A9.867 9.867 0 010 19.54a13.94 13.94 0 007.548 2.212c9.055 0 14.004-7.496 14.004-13.986 0-.213-.005-.425-.014-.636A10.012 10.012 0 0024 4.557z"/>
                </svg>
            </a>
        </div>
    </footer>

@endsection
