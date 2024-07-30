<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user =  new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'company_name' => $data['company_name'] ?? "",
            'user_type' => $data['user_type'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        $profil = $user->profil;

        if ($profil == null) {
            $profil = new \App\Models\Profil();
            $profil->user_id = $user->id;
            $profil->working_days = 0;
            $profil->category_id = 1;
            

            $baseUsername = Str::slug($user->first_name . $user->name);
            // Check if the base username already exists
            if (Profil::where('username', $baseUsername)->exists()) {
                $username = $baseUsername . '-' . uniqid(); // Append unique identifier if username exists
            } else {
                $username = $baseUsername; 
            }
            $profil->username = $username;
            $profil->save();
        }

        return $user;
    }
}
