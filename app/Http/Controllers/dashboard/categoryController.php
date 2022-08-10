<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index()
    {
        $categories = Category::
        whenSearch(request()->search)->withCount('movies')->paginate(20);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.add');
    }


    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:categories,name'
        ]);
        $request_data = $request->except(['_token', '_method']);
        Category::create($request_data);
        session()->flash('success', 'Data added successfully');
        return redirect()->route('dashboard.categories.index');
    }


    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));

    }


    public function update(Request $request, Category $category)
    {
        $validator = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id
        ]);
        $request_data = $request->except(['_token', '_method']);
        $category->update($request_data);
        session()->flash('success', 'Data updated successfully');
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', 'Data Deleted successfully');
        return redirect()->route('dashboard.categories.index');
    }
}
