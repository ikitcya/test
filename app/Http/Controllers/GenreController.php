<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return response()->json(Genre::all());
    }

    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return response()->json($genre->movies()->paginate(10));
    }
}
