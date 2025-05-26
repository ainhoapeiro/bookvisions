<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Selección de libros con ilustraciones destacadas (puedes personalizar el criterio)
        $books = Book::with('illustration')->take(6)->get();

        return view('home', compact('books'));
    }
}
