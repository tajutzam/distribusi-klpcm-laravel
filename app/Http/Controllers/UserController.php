<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where('nip', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%");
        }

        $users = $query->paginate(10);

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view("pages.user.create");
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'nip' => 'required|digits:16',
                'role' => 'required|in:admin,petugas loket,kepala puskesmas,petugas penyimpanan',
                'username' => 'required|unique:users,username',
                'password' => 'required|confirmed'
            ]
        );


        User::create(
            [
                'name' => $request->name,
                'nip' => $request->nip,
                'role' => $request->role,
                'password' => bcrypt($request->password),
                'username' => $request->username
            ]
        );

        return redirect()->route('user.index')->with('success', 'user addedd successfully');
    }


    public function edit($id)
    {

        $user = User::findOrFail($id);

        return view("pages.user.edit", compact("user"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'sometimes|nullable|confirmed|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->nip = $request->nip;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted dsuccessfully');
    }
}
