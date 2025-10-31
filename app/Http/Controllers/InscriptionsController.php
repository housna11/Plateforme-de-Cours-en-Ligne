<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cours;


class InscriptionsController extends Controller
{
    public function inscriptions(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'cour_id' => 'required|exists:cours,id',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $course = Cours::findOrFail($validated['cour_id']);

        if ($user->etudiant()->where('cour_id'->$course_id)->exists()) {
            return response()->json(['message' =>'Déjà inscrit à ce cours']);

        };
        $user->etudiant()->attach($course->id);

        return response()->json(['message' =>'Inscription réussie']);


    }

}
