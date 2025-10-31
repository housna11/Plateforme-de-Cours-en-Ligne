<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;

class CoursController extends Controller
{
     public function index()
    {
        return response()->json(Cours::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'prof_id' => 'required|exists:users,id',
        ]);

        $course = Cours::create($validated);
        return response()->json($course);
    }

     public function show($id)
    {
        $course = Cours::findOrFail($id);
        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $course = Cours::findOrFail($id);
         $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
        ]);

        $course->update($validated);
        return response()->json($course);
    }

    public function destroy($id){
        $course = Cours::findOrFail($id);
        $course->delete();
        return response()->json(['message' => 'Cours supprime']);
    }


    
}
