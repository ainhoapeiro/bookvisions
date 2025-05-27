<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Illustration;
use App\Models\Book;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->paginate(10);
        $illustrations = Illustration::latest()->paginate(10);
        $books = Book::latest()->paginate(10);

        return view('admin.panel', compact('users', 'illustrations', 'books'));
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }

    public function deleteIllustration($id)
    {
        Illustration::findOrFail($id)->delete();
        return back()->with('success', 'Ilustración eliminada correctamente.');
    }

    public function deleteBook($id)
    {
        Book::findOrFail($id)->delete();
        return back()->with('success', 'Libro eliminado correctamente.');
    }
}
