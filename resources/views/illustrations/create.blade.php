@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <h2 class="text-center text-2xl font-bold border-b pb-4 pt-8">
            {{ __('Upload Illustration') }}
        </h2>
    </div>

    <div class="max-w-xl mx-auto py-10">
        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('illustrations.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block font-medium">{{ __('Title') }}</label>
                <input type="text" name="title" id="title" class="w-full border rounded p-2" placeholder="{{ __('Title of the illustration') }}" required>
            </div>

            <div>
                <label for="description" class="block font-medium">{{ __('Description') }}</label>
                <textarea name="description" id="description" class="w-full border rounded p-2" placeholder="{{ __('Short description') }}"></textarea>
            </div>

            <div>
                <label for="image_path" class="block font-medium">{{ __('Image') }}</label>
                <input type="file" name="image_path" id="image_path" class="w-full border rounded p-2" accept="image/*" required>
            </div>

            <div>
                <label for="book_id" class="block font-medium">{{ __('Book') }}</label>
                <select name="book_id" id="book_id" class="w-full border rounded p-2 bg-white text-gray-700 focus:ring-purple-500 focus:border-purple-500">
                    <option disabled selected value="">{{ __('Select a book') }}</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" class="text-gray-800 py-2">📘 {{ $book->title }}</option>
                    @endforeach
                </select>
                <div class="text-right mt-2">
                    <a href="{{ route('books.create') }}" class="text-sm text-purple-600 hover:underline">
                        {{ __('Don\'t see your book? Add it here.') }}
                    </a>
                </div>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700">
                {{ __('Upload Illustration') }}
            </button>
        </form>
    </div>
@endsection
