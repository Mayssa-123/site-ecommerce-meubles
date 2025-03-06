<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;  // Ajoutez cette ligne pour utiliser la façade Auth

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $roles = Role::paginate(10);
            $currentUser = auth()->user();
            return view('roles.index', compact('roles','currentUser'));
            } else {
                return redirect('/')->with('error', 'Accès refusé.');
            }
    }

    // Afficher le formulaire pour créer un nouveau rôle
    public function create()
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $currentUser=auth()->user();

            return view('roles.create',compact('currentUser'));

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }

    }

    // Enregistrer un nouveau rôle
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:255',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    // Afficher un rôle spécifique avec ses utilisateurs
    public function show($id)
    {
        $role = Role::with('users')->findOrFail($id);
        return view('roles.show', compact('role')); // Vous devez créer une vue pour afficher le rôle avec ses utilisateurs
    }

    // Afficher le formulaire d'édition pour un rôle
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $role = Role::findOrFail($id);
            $currentUser=auth()->user();

            return view('roles.edit', compact('role','currentUser')); // Vous devez créer une vue pour ce formulaire
        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }


    }

    // Mettre à jour un rôle
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id . '|max:255', // Valider sauf pour le rôle actuel
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return response()->json(['success' => 'Role deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting role'], 500);
        }
    }

}
