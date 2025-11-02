<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class UsersController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
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

        return response()->json($user);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'role' => 'sometimes|in:admin,professeur,etudiant',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succes']);
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
