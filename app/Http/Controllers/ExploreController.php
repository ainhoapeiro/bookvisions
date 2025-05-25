<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use App\Models\Book;

class ExploreController extends Controller
{
    public function index()
    {
        $genders = Gender::with(['books' => function ($query) {
            $query->limit(4);
        }])->get();

        return view('explore.index', compact('genders'));
    }

    public function showGenre($id)
    {
        $gender = Gender::with('books.illustrations')->findOrFail($id);
        return view('explore.genre', compact('gender'));
    }

    public function showBook($id)
    {
        $book = Book::with(['gender', 'illustrations'])->findOrFail($id);
        return view('explore.book', compact('book'));
    }

}

