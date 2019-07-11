<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Exception;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users', compact('users'));
    }

    public function viewUser(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user != false ? $item_exists = true : $item_exists = false;
        return view('view_user', compact('user', 'item_exists'));
    }

    public function editUser(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user != false ? $item_exists = true : $item_exists = false;
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view('edit_user', compact('user', 'item_exists', 'roles'));
    }

    public function createUser(Request $request) {
        $roles = Role::orderBy('created_at', 'desc')->get();
        $roles != false ? $item_exists = true : $item_exists = false;
        return view('create_user', compact('roles', 'item_exists'));
    }

    public function storeUser(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed','string', 'min:8'],
            'role'  => ['required', 'int'],
        ]);

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $role = Role::createUserRole([
            'user_id' => $user->id,
            'role_id' => $data['role'],
        ]);

        return redirect()->to('/admin/users')->with('success', 'New user successfully created!');
    }

    public function updateUser(Request $request) {
        if ($request->input('password')) {
            $data = $request->validate([
                'id' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'confirmed', 'string', 'min:8'],
                'role'  => ['required', 'int'],
            ]);

            $user = User::find($data['id']);
            if($user->email !== $request->input('email')) {
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
                $user->email = $request->input('email');
            }
            $user->name = $data['name'];
            $user->password = Hash::make($data['password']);
            $user->save();

            Role::updateUserRole([
                'user_id' => $data['id'],
                'role_id' => $data['role'],
            ]);
        } else {
            $data = $request->validate([
                'id' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'role'  => ['required', 'int'],
            ]);

            $user = User::find($data['id']);
            if($user->email !== $request->input('email')) {
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
                $user->email = $request->input('email');
            }
            $user->name = $data['name'];
            $user->save();

            Role::updateUserRole([
                'user_id' => $data['id'],
                'role_id' => $data['role'],
            ]);
        }

        return redirect()->to('/admin/users')->with('message', 'New user successfully created!');
    }

    public function deleteUser(Request $request) {
        $data = $request->validate([
            'id'    => 'required|string',
        ]);

        $user = User::find($data['id']);
        $user->delete();

        return redirect()->to('admin/users')->with('message', 'User deleted!');
    }
}