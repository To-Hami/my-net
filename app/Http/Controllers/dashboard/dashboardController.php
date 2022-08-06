<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }
}
