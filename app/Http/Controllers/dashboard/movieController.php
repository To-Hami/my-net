<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\StreamMovie;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class movieController extends Controller
{
    public function index(Movie $movie)
    {
        $categories = Category::all();
        $movies = Movie::whenSearch(request()->search)
            ->whenCategory(request()->category)
            ->with('categories')
            ->paginate(50);
        return view('dashboard.movies.index', compact('categories', 'movies'));
    }

    public function create()
    {
        $categories = Category::all();

        $movie = Movie::create([]);
        return view('dashboard.movies.add', compact('movie', 'categories'));
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
        $categories = Category::all();
        return view('dashboard.movies.edit', compact('categories', 'movie'));
    }


    public function update(Request $request, Movie $movie)
    {

        $request_data = $request->except(['_token', '_method', 'categories', 'type', 'poster', 'image']);


        if ($request->type == 'publish') {
            $validator = $request->validate([
                'name' => 'required|unique:Movies,name,' . $movie->id,
                'description' => 'required',
                'poster' => 'required |image',
                'image' => 'required |image',
                'categories' => 'required |array',
                'year' => 'required',
                'rating' => 'required',
            ]);
        } else {
            $validator = $request->validate([
                'name' => 'required|unique:Movies,name,' . $movie->id,
                'description' => 'required',
                'poster' => 'sometimes |nullable |image',
                'image' => 'sometimes|nullable |image',
                'categories' => 'required |array',
                'year' => 'required',
                'rating' => 'required',
            ]);
        }


        //   if send poster
        if ($request->poster) {
            $this->remove_previous('poster', $movie);
            $poster = Image::make($request->poster)
                ->resize(255, 378)
                ->encode('jpg');

            Storage::disk('local')
                ->put('public/images/' . $request->poster->hashName(),
                    (string)$poster, 'public');

            $request_data['poster'] = $request->poster->hashName();
        }

        //   if send image
        if ($request->image) {

            $this->remove_previous('image', $movie);
            $image = Image::make($request->image)
                ->encode('jpg', 50);

            Storage::disk('local')
                ->put('public/images/' . $request->image->hashName(),
                    (string)$image, 'public');

            $request_data['image'] = $request->image->hashName();
        }

        $movie->update($request_data);

        $movie->categories()->sync($request->categories);

        session()->flash('success', 'Data updated successfully');
        return redirect()->route('dashboard.movies.index');
    }

    public function destroy(Movie $movie)
    {

        Storage::disk('local')->delete($movie->path);

        Storage::disk('local')->delete('public/images/' . $movie->poster);
        Storage::disk('local')->delete('public/images/' . $movie->image);

        Storage::disk('local')->deleteDirectory('public/movies/' . $movie->id);

        $movie->delete();
        session()->flash('success', 'Data Deleted successfully');
        return redirect()->route('dashboard.movies.index');
    }


    private function remove_previous($image_type, $movie)
    {
        if ($image_type == 'poster') {

            if ($movie->poster != null) {
                Storage::disk('local')->delete('public/images/' . $movie->poster);
            }
        } else {
            if ($movie->image != null) {
                Storage::disk('local')->delete('public/images/' . $movie->image);
            }
        }
    }

}
