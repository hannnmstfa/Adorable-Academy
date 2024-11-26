<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('rolesuperadmin.usermanage.index', compact('users'));
    }
    
    public function create(){
        return view('rolesuperadmin.usermanage.create');
    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'nama' => ['required', 'string', 'max:225'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')],
            'phone' => ['required', 'string', 'max:225', Rule::unique('users')],
            'role' => ['required', 'string', 'max:225'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => $request->password
        ]);

        return redirect()->route('usersmanage.index')->with('success', 'User '.$request->nama.' Berhasil Ditambahkan');
    }

    public function destroy($id){
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('usersmanage.index')->with('success', 'User Berhasil dihapus');
    }

    public function edit($id){
        $users = User::find($id);
        return view('rolesuperadmin.usermanage.edit', compact('users'));
    }

    public function update(Request $request, $id){
        $users = User::findOrFail($id);
        $request->validate([
            'nama'=> ['required', 'string', 'max:225'],
            'email' => ['required', 'string', 'email', 'max:225', Rule::unique('users')->ignore($users->id)],
            'phone' => ['required', 'string', 'max:225', Rule::unique('users')->ignore($users->id)],
            'role' => ['required', 'string', 'max:225']
        ]);

        $users->update([
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ]);
        return redirect()->route('usersmanage.index')->with('success', 'Data User ' . $users->name .' Berhasil Di Update');
    }

    public function resetpass($id){
        $users = User::findOrFail($id);
        $users->update([
            'password' => 'password123'
        ]);
        return redirect()->route('usersmanage.edit', $id)->with('success', 'Password Berhasil Di Reset ke Default');
    }
}
