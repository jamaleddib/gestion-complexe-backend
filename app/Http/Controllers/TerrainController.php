<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use Illuminate\Http\Request;

class TerrainController extends Controller
{
    public function index()
    {
        return response()->json(Terrain::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'type' => 'nullable|string|max:100',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('terrains', 'public');
        }

        $terrain = Terrain::create($validated);

        return response()->json($terrain, 201);
    }

    public function update(Request $request, Terrain $terrain)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prix' => 'sometimes|required|numeric|min:0',
            'type' => 'nullable|string|max:100',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('terrains', 'public');
        }

        $terrain->update($validated);

        return response()->json($terrain);
    }

    public function destroy(Terrain $terrain)
    {
        $terrain->delete();

        return response()->json(['message' => 'Terrain supprimé avec succès']);
    }
}
