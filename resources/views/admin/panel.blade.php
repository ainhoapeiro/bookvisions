@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Panel de Administración</h1>

        {{-- Usuarios --}}
        <details class="mb-6 border rounded-lg p-4">
            <summary class="text-xl font-semibold cursor-pointer">Usuarios ({{ $users->total() }})</summary>
            <ul class="mt-4 space-y-2">
                @foreach ($users as $user)
                    <li class="flex justify-between items-center">
                        {{ $user->username }}
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="inline" data-confirm="¿Estás seguro de que quieres eliminar este usuario?">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </details>

        {{-- Ilustraciones --}}
        <details class="mb-6 border rounded-lg p-4">
            <summary class="text-xl font-semibold cursor-pointer">Ilustraciones ({{ $illustrations->total() }})</summary>
            <ul class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($illustrations as $illustration)
                    <li class="border rounded-lg overflow-hidden shadow p-2 text-center">
                        <img src="{{ asset($illustration->image_path) }}" alt="{{ $illustration->title }}" class="w-full h-40 object-cover mb-2 rounded">
                        <div class="font-semibold">{{ $illustration->title }}</div>
                        <form action="{{ route('admin.deleteIllustration', $illustration->id) }}" method="POST" class="mt-1" data-confirm="¿Eliminar esta ilustración?">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline text-sm">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4">
                {{ $illustrations->links() }}
            </div>
        </details>

        {{-- Libros --}}
        <details class="mb-6 border rounded-lg p-4">
            <summary class="text-xl font-semibold cursor-pointer">Libros ({{ $books->total() }})</summary>
            <ul class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($books as $book)
                    <li class="border rounded-lg overflow-hidden shadow p-2 text-center">
                        <img src="{{ asset('books/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-40 object-cover mb-2 rounded">
                        <div class="font-semibold">{{ $book->title }}</div>
                        <form action="{{ route('admin.deleteBook', $book->id) }}" method="POST" class="mt-1" data-confirm="¿Eliminar este libro?">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline text-sm">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4">
                {{ $books->links() }}
            </div>
        </details>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form[data-confirm]').forEach(form => {
                form.addEventListener('submit', function (e) {
                    const message = this.getAttribute('data-confirm');
                    if (!confirm(message)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection
