<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Illustration;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Collection;
use App\Models\Book;

class IllustrationController extends Controller
{
    public function create()
    {
        $books = Book::all();
        return view('illustrations.create', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'required|image|max:2048',
            'description' => 'nullable|string',
            'book_id' => 'required|exists:books,id',
        ]);

        $path = $request->file('image_path')->store('illustration', 'public');

        Illustration::create([
            'title' => $validated['title'],
            'image_path' => $path,
            'description' => $validated['description'] ?? null,
            'user_id' => Auth::id(),
            'book_id' => $validated['book_id'],
        ]);

        return redirect()->route('profile.view', Auth::id())->with('success', 'Ilustración subida correctamente.');
    }

    public function show($id)
    {
        $illustration = Illustration::with(['book', 'user', 'comments.user'])->findOrFail($id);
        $collections = auth()->check() ? auth()->user()->collections : collect();

        return view('illustrations.show', compact('illustration', 'collections'));
    }

    public function like($id)
    {
        $user = Auth::user();
        $illustration = Illustration::findOrFail($id);

        // Aquí debes implementar lógica para toggle like,
        // por ejemplo usando una tabla intermedia user_illustration_likes
        if ($user->likedIllustrations()->where('illustration_id', $id)->exists()) {
            $user->likedIllustrations()->detach($id);
        } else {
            $user->likedIllustrations()->attach($id);
        }

        return back();
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $illustration = Illustration::findOrFail($id);

        Comment::create([
            'user_id' => $user->id,
            'illustration_id' => $illustration->id,
            'content' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Comentario añadido correctamente.');
    }

    public function saveToCollection(Request $request, $id)
    {
        $user = Auth::user();
        $illustration = Illustration::findOrFail($id);

        // dd($request->all()); // Úsalo para depurar si hace falta

        if ($request->filled('collection')) {
            $collection = Collection::findOrFail($request->collection);
        } elseif ($request->filled('new_collection')) {
            $collection = Collection::create([
                'user_id' => $user->id,
                'title' => $request->new_collection,
                'description' => $request->new_description ?? '',
            ]);
        } else {
            return back()->withErrors(['collection' => 'Debes seleccionar o crear una colección.']);
        }

        // Previene duplicados
        if (!$collection->illustrations()->where('illustration_id', $illustration->id)->exists()) {
            $collection->illustrations()->attach($illustration->id);
        }

        return back()->with('success', 'Ilustración guardada en colección.');
    }

}
