<?php

namespace App\Http\Controllers;

use App\Models\IdVerification;
use Illuminate\Http\Request;

class VerifyIdentityController extends Controller
{

    public function verify_identity()
    {
        $user_verification = IdVerification::where('user_id', auth()->user()->id)
            ->where('is_rejected', 0)
            ->orderBy('created_at', 'DESC')
            ->first();
        // dd($user_verification);
        return view('verify_identity', compact('user_verification'));
    }

    public function verify_identity_post(Request $request)
    {

        $request->validate([
            'number' => 'required',
            'type' => 'required|in:id,passport,driving_license',
            'document' => 'required|file',
        ]);

        $document = $request->file('document');
        $fileNameWithExtension = $document->getClientOriginalName();
        $name = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        $filename = $name . '_' . substr(time(), 0, 4) . '.' . $document->getClientOriginalExtension();
        $document->storeAs('public', $filename);

        $idVerification = new IdVerification();
        $idVerification->number = $request->number;
        $idVerification->type = $request->type;
        $idVerification->path = $filename;
        $idVerification->user_id = auth()->user()->id;

        $idVerification->save();

        return redirect()->back()->with('success_id', 'Identité enregistrée avec succes');
    }
}
