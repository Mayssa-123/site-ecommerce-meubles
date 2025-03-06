<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;



use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Hash;



class UsersController extends Controller
{
    public function index()

    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $users = User::paginate(10);
            $currentUser = auth()->user();
            return view('users.index', compact('users','currentUser'));
        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }


    }


    /**
     * Affiche le formulaire de création d'un utilisateur.
     */
    public function create()
{
    if (Auth::check() && Auth::user()->role->name === 'Admin') {
        $roles = Role::all();
        $currentUser=auth()->user();

    return view('users.create', compact('roles','currentUser'));
    } else {
        return redirect('/')->with('error', 'Accès refusé.');
    }

}

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',

    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role_id' => $request->role_id,
    ]);

    return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
}



    /**
     * Affiche le formulaire d'édition pour un utilisateur spécifique.
     */
    public function edit(User $user)
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $currentUser=auth()->user();

            return view('users.edit', compact('user','currentUser'));

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }
    }

    /**
     * Met à jour les informations d'un utilisateur.
     */
    public function update(Request $request, User $user)
{

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        'password' => 'nullable|string|min:3|confirmed',
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
    ]);

    return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
}

    /**
 * Affiche le formulaire de modification du rôle d'un utilisateur.
 */
public function editRole(User $user)
{
    if (Auth::check() && Auth::user()->role->name === 'Admin') {
        $roles = Role::all(); // Récupère tous les rôles
        $currentUser=auth()->user();

    return view('users.editRole', compact('user', 'roles','currentUser'));

    } else {
        return redirect('/')->with('error', 'Accès refusé.');
    }

}


public function updateRole(Request $request, User $user)
{
    if (Auth::check() && Auth::user()->role->name === 'Admin') {
        $request->validate([
            'role_id' => 'required|exists:roles,id', // Validation de l'ID du rôle
        ]);

        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Le rôle de l\'utilisateur a été mis à jour.');

    } else {
        return redirect('/')->with('error', 'Accès refusé.');
    }

}

    /**
     * Supprime un utilisateur.
     */
    public function destroy(User $user)
{
    if (Auth::check() && Auth::user()->role->name === 'Admin') {
        $user->delete();
        return response()->json(['message' => 'Utilisateur supprimé avec succès.']);
    } else {
        return redirect('/')->with('error', 'Accès refusé.');
    }


}
public function updatePassword(Request $request)
{
    // Récupérer l'utilisateur authentifié
    $user = Auth::user();

    // Validation des champs
    $request->validate([
        'current_password' => 'required', // Mot de passe actuel obligatoire
        'new_password' => 'required|string|min:6|confirmed', // Nouveau mot de passe avec confirmation
    ]);

    // Vérifier que l'ancien mot de passe est correct
    if (!Hash::check($request->current_password, $user->password)) {
        // Si le mot de passe actuel est incorrect, renvoyer une erreur
        return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
    }

    // Mettre à jour le mot de passe si l'ancien est correct
    $user->update([
        'password' => Hash::make($request->new_password), // Hachage du nouveau mot de passe
    ]);

    return back()->with('success', 'Le mot de passe a été modifié avec succès.');
}




}
