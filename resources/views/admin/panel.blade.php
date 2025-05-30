@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Panel de Administración</h1>

        @if(session('success'))
            <div class="bg-[#edc865] text-black px-4 py-3 rounded mb-4 shadow text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif

        {{-- Usuarios --}}
        <details class="mb-6 border rounded-lg p-4" open>
            <summary class="text-xl font-semibold cursor-pointer">Usuarios ({{ $users->count() }})</summary>
            <div id="usuarios-section" class="max-h-96 overflow-y-auto mt-4 pr-2">
                <ul class="space-y-2">
                    @foreach ($users as $user)
                        <li class="flex justify-between items-center">
                            {{ $user->username }}
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" data-confirm>
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </details>

        {{-- Ilustraciones --}}
        <details class="mb-6 border rounded-lg p-4" open>
            <summary class="text-xl font-semibold cursor-pointer">Ilustraciones ({{ $illustrations->count() }})</summary>
            <div id="ilustraciones-section" class="max-h-96 overflow-y-auto mt-4 pr-2">
                <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($illustrations as $illustration)
                        <li class="border rounded-lg overflow-hidden shadow p-2 text-center">
                            <img src="{{ asset($illustration->image_path) }}" alt="{{ $illustration->title }}" class="w-full h-40 object-cover mb-2 rounded">
                            <div class="font-semibold">{{ $illustration->title }}</div>
                            <form action="{{ route('admin.deleteIllustration', $illustration->id) }}" method="POST" class="mt-1" data-confirm>
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">Eliminar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </details>

        {{-- Libros --}}
        <details class="mb-6 border rounded-lg p-4" open>
            <summary class="text-xl font-semibold cursor-pointer">Libros ({{ $books->count()}})</summary>
            <div id="libros-section" class="max-h-96 overflow-y-auto mt-4 pr-2">
                <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($books as $book)
                        <li class="border rounded-lg overflow-hidden shadow p-2 text-center">
                            <img src="{{ asset('books/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-40 object-cover mb-2 rounded">
                            <div class="font-semibold">{{ $book->title }}</div>
                            <form action="{{ route('admin.deleteBook', $book->id) }}" method="POST" class="mt-1" data-confirm>
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">Eliminar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </details>
    </div>

    {{-- Modal de confirmación --}}
    <div id="confirm-modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md border-2 border-[#8f6baa] text-center">
            <h3 class="text-lg font-bold text-[#263a5e] mb-4">⚠️ ¿Estás seguro?</h3>
            <p class="text-gray-600 mb-6">Esta acción no se puede deshacer.</p>
            <div class="flex justify-center gap-4">
                <button id="cancel-btn" class="px-4 py-2 bg-[#f9f6f6] text-gray-800 rounded hover:bg-gray-200">Cancelar</button>
                <button id="confirm-btn" class="px-4 py-2 bg-[#edc865] text-[#263a5e] rounded hover:bg-[#f4d25e] font-semibold">Eliminar</button>
            </div>
        </div>
    </div>

    {{-- Script para el modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let targetForm = null;

            document.querySelectorAll('form[data-confirm]').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    targetForm = this;
                    document.getElementById('confirm-modal').classList.remove('hidden');
                });
            });

            document.getElementById('cancel-btn').addEventListener('click', () => {
                document.getElementById('confirm-modal').classList.add('hidden');
                targetForm = null;
            });

            document.getElementById('confirm-btn').addEventListener('click', () => {
                if (targetForm) {
                    targetForm.submit();
                }
            });
        });
    </script>
@endsection
