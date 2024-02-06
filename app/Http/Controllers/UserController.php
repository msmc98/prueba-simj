<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //show all users
    public function index()
    {
        $users = User::all();
        return view('usuarios.users-table', compact('users'));
    }

    //create user
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
        //return index function
        $users = User::all();
        return view('usuarios.users-table', compact('users'));
    }

    //edit user
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = $request->password;
        }
        $user->save();
        //return index function
        $users = User::all();
        return view('usuarios.users-table', compact('users'));
    }

    //delete user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
}
