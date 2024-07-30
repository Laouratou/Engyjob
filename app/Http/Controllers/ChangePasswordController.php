<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function change_password()
    {
        return view('change_password');
    }

    public function change_password_post(Request $request)
    {

        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->with('error', 'Le mot de passe actuel n\'est pas le bon');
        }

        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('error', 'Les mots de passe ne sont pas identiques');
        }

        $user = User::findOrFail(auth()->user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Le mot de passe a été changé avec succès');
    }
}