<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class AdminController extends Controller
{
    public function users()
    {
        return Inertia::render('AdminUsers', [
            'users' => User::with('roles')->get()
        ]);
    }
}