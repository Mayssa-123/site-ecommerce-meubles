<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // <-- Importer la façade Auth
use Illuminate\Support\Facades\Password;

use Illuminate\Http\Request;
use App\Models\User;

class PasswordController extends Controller
{
    public function index()
{
    if (!Auth::check()) {
        return redirect('/login'); // Redirige vers la page de connexion si non connecté
    }
    $user = Auth::user(); // Récupérer l'utilisateur connecté
    return view('passwords.index', compact('user'));
}


public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $response = Password::sendResetLink(
        $request->only('email')
    );

    if ($response == Password::RESET_LINK_SENT) {
        return back()->with('status', trans($response));
    }

    return back()->withErrors(['email' => trans($response)]);
}

}
