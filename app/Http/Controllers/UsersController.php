<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class UsersController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'in:admin,professeur,etudiant',
        ]);


        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json($user, 201);
    }


    public function etudiant($id)
    {
        $user = User::findOrFail($id);

        return $user->etudiant;
    }


    public function professeur($id)
    {
        $user = User::findOrFail($id);

        return $user->professeur;
    }
}
