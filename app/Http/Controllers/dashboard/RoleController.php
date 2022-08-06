<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index(Role $role)
    {
        $roles = Role::whenSearch(request()->search)->WhenRoleNotIn(['super_admin', 'admin', 'user'])->paginate(20);
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('dashboard.roles.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);


        $role = Role::create($request->only(['name']));
        $role->attachPermissions($request->permissions);


        session()->flash('success', 'Data added successfully');
        return redirect()->route('dashboard.roles.index');
    }


    public function edit(Category $category)
    {
        return view('dashboard.roles.edit', compact('category'));

    }


    public function update(Request $request, Category $category)
    {
        $validator = $request->validate([
            'name' => 'required|unique:roles,name,' . $category->id
        ]);
        $request_data = $request->except(['_token', '_method']);
        $category->update($request_data);
        session()->flash('success', 'Data updated successfully');
        return redirect()->route('dashboard.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('success', 'Data Deleted successfully');
        return redirect()->route('dashboard.roles.index');
    }
}
