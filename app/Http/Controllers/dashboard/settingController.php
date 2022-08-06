<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class settingController extends Controller
{
    public function social_login()
    {
        return view('dashboard.setting.social_login');
    }

    public function social_link()
    {
        return view('dashboard.setting.social_link');
    }

    public function store(Request $request)
    {
        setting($request->all())->save();
        session()->flash('success', 'Setting added successfully');
        return redirect()->back();
    }
}
