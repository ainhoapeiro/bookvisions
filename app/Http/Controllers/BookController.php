<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Gender;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        $genders = Gender::all();
        return view('books.create', compact('genders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'genre_id' => 'required|exists:genders,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('books'), $filename);
            $validated['image'] = $filename;
        }


        $book = Book::create($validated);

        return redirect()->route('illustrations.create', ['selected_book' => $book->id])
            ->with('success', 'Libro añadido con éxito.');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Buscar libros por título o autor (puedes ajustar)
        $books = \App\Models\Book::where('title', 'like', "%$query%")
            ->orWhere('author', 'like', "%$query%")
            ->take(20)
            ->get();

        return view('partials.search-results', compact('books'))->render();
    }

}
