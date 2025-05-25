@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <h2 class="text-center text-2xl font-bold border-b pb-4 pt-8">
            {{ __('Add New Book') }}
        </h2>
    </div>

    <div class="max-w-xl mx-auto py-10">
        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block font-medium">{{ __('Title') }}</label>
                <input type="text" name="title" id="title" class="w-full border rounded p-2" placeholder="{{ __('Book title') }}" required>
            </div>

            <div>
                <label for="author" class="block font-medium">{{ __('Author') }}</label>
                <input type="text" name="author" id="author" class="w-full border rounded p-2" placeholder="{{ __('Author name') }}" required>
            </div>

            <div>
                <label for="image" class="block font-medium">{{ __('Cover Image') }}</label>
                <input type="file" name="image" id="image" class="w-full border rounded p-2" accept="image/*">
            </div>

            <div>
                <label for="synopsis" class="block font-medium">{{ __('Synopsis') }}</label>
                <textarea name="synopsis" id="synopsis" class="w-full border rounded p-2" placeholder="{{ __('Short description') }}"></textarea>
            </div>

            <div>
                <label for="genre_id" class="block font-medium">{{ __('Genre') }}</label>
                <select name="genre_id" id="genre_id" class="w-full border rounded p-2">
                    <option disabled selected>{{ __('Select a genre') }}</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700">
                {{ __('Add Book') }}
            </button>
        </form>
    </div>
@endsection
