<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Models\Config;

class ConfidentialityController extends Controller
{
    public function show()
    {
        
        $configs = Config::select('confidentialite')->get();

        return view('confidentiality', compact('configs'));
    }
}
