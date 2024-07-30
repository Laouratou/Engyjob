<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Méthode pour afficher le formulaire de réinitialisation de mot de passe
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Méthode pour envoyer le lien de réinitialisation de mot de passe
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

   
}
