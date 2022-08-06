<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\StreamMovie;
use App\Models\Movie;
use Illuminate\Http\Request;

class movieController extends Controller
{
    public function index(Movie $movie)
    {
        $movies = Movie::paginate(20);
        return view('dashboard.movies.index', compact('movies'));
    }

    public function create()
    {
        $movie = Movie::create([]);
        return view('dashboard.movies.add', compact('movie'));
    }


    public function store(Request $request)
    {

        $movie = Movie::findOrFail($request->movie_id);

        $movie->update([
            'name' => $request->name,
            'path' => $request->file('movie')->store('movies')
        ]);
        dispatch(new StreamMovie($movie));
        return $movie;
    }

    public function show(Movie $movie)
    {
        return $movie;
    }

    public function edit(Movie $movie)
    {
        return view('dashboard.movies.edit', compact('movie'));

    }


    public function update(Request $request, Movie $Movie)
    {
        $validator = $request->validate([
            'name' => 'required|unique:Movies,name,' . $Movie->id
        ]);
        $request_data = $request->except(['_token', '_method']);
        $Movie->update($request_data);
        session()->flash('success', 'Data updated successfully');
        return redirect()->route('dashboard.movies.index');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        session()->flash('success', 'Data Deleted successfully');
        return redirect()->route('dashboard.movies.index');
    }
}
