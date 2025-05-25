<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show($id)
    {
        $collection = \App\Models\Collection::with('illustration.book', 'user')->findOrFail($id);
        return view('collections.show', compact('collection'));
    }

}
