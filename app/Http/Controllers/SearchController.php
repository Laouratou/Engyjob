<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Freelance;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $type_search = $request->input('type_search');
        $keyword = $request->input('keywords');

        // mettre en session
        session()->put('type_search', $type_search);
        session()->put('keywords', $keyword);

        // dd($keyword);



        if ($type_search == 'Projets') {
            return redirect()->route('projects.liste');
        } else {
            return redirect()->route('freelancers.liste');
        }
    }
}
