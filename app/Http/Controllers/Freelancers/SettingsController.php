<?php

namespace App\Http\Controllers\Freelancers;

use App\Models\User;
use App\Models\Profil;
use App\Models\Category;
use App\Models\FreelancerType;
use App\Models\Education;
use App\Models\Experience;
use App\Models\FreelancerSkill;
use App\Models\Skill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfilRequest;

class SettingsController extends Controller
{
    public function FreelancersProfileSettings()
    {
        $user = auth()->user();
        $profil = $user->profil;

        if ($profil === null) {
            $profil = new Profil();
            $profil->user_id = $user->id;

            $baseUsername = Str::slug($user->first_name . $user->name);
            if (Profil::where('username', $baseUsername)->exists()) {
                $username = $baseUsername . '-' . uniqid();
            } else {
                $username = $baseUsername;
            }

            $profil->username = $username;
            $profil->save();
        }

        $freelancersTypes = FreelancerType::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $skills = Skill::where('is_active', 1)->get();

        // Convertir les jours de travail en tableau pour la vue
        $workDays = $profil->work_days ? json_decode($profil->work_days, true) : [];

        return view('freelancers.profile_settings', compact(
            'user',
            'freelancersTypes',
            'categories',
            'profil',
            'skills',
            'workDays'
        ));
    }

    public function FreelancersProfileSettingsUpdate(UpdateUserProfilRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
    
        $baseUsername = Str::slug($request->first_name . $request->name);
        if (Profil::where('username', $baseUsername)->exists()) {
            $username = $baseUsername . '-' . uniqid();
        } else {
            $username = $baseUsername;
        }
    
        $profil = $user->profil;
    
        // Mettre à jour les informations de base de l'utilisateur
        $user->fill($request->only('first_name', 'name', 'email', 'phone', 'company_name'));
        if ($user->user_type === 'company' && !$request->company_name) {
            return redirect()->back()->with('error', 'Veuillez renseigner le nom de votre entreprise');
        }
        $user->save();
    
        // Mettre à jour le profil du freelance
        $profil->fill($request->except('first_name', 'name', 'email', 'phone', 'company_name', 'image', 'educations', 'experiences', 'skills'));
        $profil->username = $username;
    
        // Gérer le téléchargement d'une nouvelle image de profil
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileNameWithExtension = $image->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = '/user_profil_images/' . $fileName . '_' . time() . '.' . $extension;
            $destinationPath = 'user_profil_images/';
            $image->move($destinationPath, $fileNameToStore);
    
            $profil->photo = $fileNameToStore;
        }
    
        // Convertir et sauvegarder les jours de travail en format JSON
        $profil->work_days = json_encode($request->input('work_days', []));
    
        $profil->save();
    
        // Supprimer et enregistrer les éducations
        Education::where('user_id', $user_id)->delete();
        if ($request->has('educations') && is_array($request->educations)) {
            foreach ($request->educations as $education) {
                $educa = new Education();
                $educa->fill($education);
                $educa->user_id = $user_id;
                $educa->save();
            }
        }
    
        // Supprimer et enregistrer les expériences
        Experience::where('user_id', $user_id)->delete();
        if ($request->has('experiences') && is_array($request->experiences)) {
            foreach ($request->experiences as $experience) {
                $expe = new Experience();
                $expe->fill($experience);
                $expe->user_id = $user_id;
                $expe->save();
            }
        }
    
        // Supprimer et enregistrer les compétences du freelance
        FreelancerSkill::where('user_id', $user_id)->delete();
        if ($request->has('skills') && is_array($request->skills)) {
            foreach ($request->skills as $skill) {
                $freelancerSkill = new FreelancerSkill();
                $freelancerSkill->skill_id = $skill;
                $freelancerSkill->user_id = $user_id;
                $freelancerSkill->save();
            }
        }
    
        // Rafraîchir le profil pour la vue mise à jour
        $profil->refresh();
    
        // Récupérer les jours de travail mis à jour pour la vue
        $workDays = $profil->work_days ? json_decode($profil->work_days, true) : [];
    
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Vos informations ont bien été mises à jour.')->with(compact('workDays'));
    }
    
}
