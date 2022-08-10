<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;

class welcomeController extends Controller
{
    public function index()
    {
        $latest_movies = Movie::latest()->limit(10)->get();
        $categories = Category::with('movies')->get();
        return view('welcome', compact('latest_movies', 'categories'));
    }
}
