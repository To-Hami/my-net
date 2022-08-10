<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Models\User;

class dashboardController extends Controller
{
    public function index()
    {

        $users_count = User::count();
        $categories_count = Category::count();
        $movies_count = Movie::count();
        return view('dashboard.dashboard', compact('movies_count', 'categories_count', 'users_count'));
    }
}
