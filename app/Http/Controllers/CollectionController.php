<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show($id)
    {
        $collection = \App\Models\Collection::with('illustrations.book', 'user')->findOrFail($id);
        return view('collections.show', compact('collection'));
    }

}
