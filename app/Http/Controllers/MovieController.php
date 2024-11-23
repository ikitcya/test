<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        return response()->json(Movie::with('genres')->paginate(10));
    }

    public function show($id)
    {
        return response()->json(Movie::with('genres')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $posterPath = $request->file('poster')
                      ? $request->file('poster')->store('posters')
                      : 'default_poster.jpg';

        $movie = Movie::create([
            'title' => $validated['title'],
            'poster' => $posterPath,
            'is_published' => false
        ]);

        return response()->json($movie, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $movie = Movie::findOrFail($id);
        $posterPath = $movie->poster;

        if ($request->hasFile('poster')) {
            if ($posterPath != 'default_poster.jpg') {
                Storage::delete($posterPath);
            }
            $posterPath = $request->file('poster')->store('posters');
        }

        $movie->update([
            'title' => $validated['title'],
            'poster' => $posterPath
        ]);

        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if ($movie->poster != 'default_poster.jpg') {
            Storage::delete($movie->poster);
        }
        $movie->delete();
        return response()->json(null, 204);
    }

    public function publish($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->publish();
        return response()->json($movie);
    }
}
