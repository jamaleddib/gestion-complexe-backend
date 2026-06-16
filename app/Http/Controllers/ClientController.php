<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = User::where('role', 'user')->get();

        return response()->json($clients);
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return response()->json($user);
    }

    
    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return response()->json(['message' => 'Impossible de supprimer un administrateur'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'Client supprimé avec succès']);
    }
}
