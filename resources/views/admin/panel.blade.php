@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Panel de Administración</h1>

        <h2 class="text-xl font-semibold mt-6">Usuarios</h2>
        <ul>
            @foreach ($users as $user)
                <li class="mb-2">
                    {{ $user->username }}
                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="ml-2 text-red-600 hover:underline">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h2 class="text-xl font-semibold mt-6">Ilustraciones</h2>
        <ul>
            @foreach ($illustrations as $illustration)
                <li class="mb-2">
                    {{ $illustration->title }}
                    <form action="{{ route('admin.deleteIllustration', $illustration->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="ml-2 text-red-600 hover:underline">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h2 class="text-xl font-semibold mt-6">Libros</h2>
        <ul>
            @foreach ($books as $book)
                <li class="mb-2">
                    {{ $book->title }}
                    <form action="{{ route('admin.deleteBook', $book->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="ml-2 text-red-600 hover:underline">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
