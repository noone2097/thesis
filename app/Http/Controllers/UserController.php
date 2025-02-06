<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::query()
                ->select('id', 'name', 'email', 'email_verified_at', 'created_at', 'is_admin')
                ->get()
                ->map(function($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'email_verified_at' => $user->email_verified_at,
                        'created_at' => $user->created_at,
                        'is_admin' => $user->is_admin
                    ];
                });

            \Log::info('Users loaded:', $users->toArray());

            return Inertia::render('AdminUsers', ['users' => $users]);
        } catch (\Exception $e) {
            \Log::error('Error loading users:', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function getUsers()
    {
        return User::query()
            ->select('id', 'name', 'email', 'email_verified_at', 'created_at', 'is_admin')
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'is_admin' => 'boolean'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin ?? false
        ]);

        return redirect()->route('admin.users');
    }
}
