<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // 📌 SHOW ALL USERS
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 📌 CREATE FORM
    public function create()
    {
        return view('admin.users.create');
    }

    // 📌 STORE USER
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role'        => 'required|in:admin,user,teacher',
            'status'      => 'required|in:1,0',
            'description' => 'nullable|string',
        ]);

        // 🖼 Image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
        }

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'image'       => $imagePath,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,   // admin | user | teacher
            'status'      => $request->status, // 1 | 0
            'description' => $request->description,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    // 📌 SHOW SINGLE USER
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // 📌 EDIT FORM
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // 📌 UPDATE USER
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'password'    => 'nullable|min:6',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role'        => 'nullable|in:admin,user,teacher',
            'status'      => 'required|in:1,0',
            'description' => 'nullable|string',
        ]);

        // ✅ Safe fields only
        $data = $request->only('name', 'email', 'status', 'description');

        // 🔐 Password optional
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 🖼 Image update
        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $data['image'] = $request->file('image')->store('users', 'public');
        }

        // 🔒 Role update only if sent
        if ($request->filled('role')) {
            $data['role'] = $request->role;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    // 📌 DELETE USER
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }
}
