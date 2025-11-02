<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
           'name'=>'required|string|max:100',
           'email'=>'required|email|unique:users',
           'password'=>'required|string|min:6',
           'role'=>'in:admin,professeur,etudiant',

        ]);
            $validated['password'] = bcrypt($validated['password']);
            $user= User::create($validated);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    //connex
    public function login(Request $request) {
        $validated = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

      $user =User::where('email', $request->email)->first();
      if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Identifiants incorrects.'],
            ]);
        }
         $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'token' => $token,
        ]);
    }  

    //Deconx
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie']);

    }
}
