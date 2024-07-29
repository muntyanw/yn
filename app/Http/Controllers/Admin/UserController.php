<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Отображение списка пользователей
    public function index()
    {
        $users = User::with('roles')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    // Форма создания нового пользователя
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    // Сохранение нового пользователя
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect()->route('admin_users_index')->with('success', 'User created successfully.');
    }

    // Форма редактирования пользователя
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Обновление пользователя
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $user->assignRole('user');

        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect()->route('admin_users_index')->with('success', 'User updated successfully.');
    }

    // Удаление пользователя
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin_users_index')->with('success', 'User deleted successfully.');
    }

    public function show($id)
    {
        $user = User::with('volunteer')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
}
