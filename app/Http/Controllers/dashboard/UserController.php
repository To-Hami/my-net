<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(User $User)
    {
        $Users = User::whereNameNot("Super Admin")->whenSearch(request()->search)->paginate(20);
        return view('dashboard.users.index', compact('Users'));
    }

    public function create()
    {
        return view('dashboard.users.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:Users,email',
            'password' => 'required|confirmed',
        ]);

        $request['password'] = bcrypt($request->password);
        // or=>   $request->merge(['password' => bcrypt($request->password)]);


        $User = User::create($request->all());

        session()->flash('success', 'Data added successfully');
        return redirect()->route('dashboard.users.index');
    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));

    }


    public function update(Request $request, User $user)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id
        ]);
        $request_data = $request->except(['_token', '_method']);
        $user->update($request_data);
        session()->flash('success', 'Data updated successfully');
        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $User)
    {
        $User->delete();
        session()->flash('success', 'Data Deleted successfully');
        return redirect()->route('dashboard.users.index');
    }
}
