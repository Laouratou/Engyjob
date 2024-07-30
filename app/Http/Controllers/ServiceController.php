<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Affiche une liste des services
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // Affiche le formulaire de création d'un service
    public function create()
    {
        return view('services.create');
    }

    // Enregistre un nouveau service
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'allowed_services' => 'required|integer',
            'offers_per_project' => 'required|integer',
            'featured_services' => 'required|integer',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')
                         ->with('success', 'Service créé avec succès.');
    }

    // Affiche un service spécifique
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    // Affiche le formulaire d'édition d'un service
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    // Met à jour un service existant
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'allowed_services' => 'required|integer',
            'offers_per_project' => 'required|integer',
            'featured_services' => 'required|integer',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')
                         ->with('success', 'Service mis à jour avec succès.');
    }

    // Supprime un service
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
                         ->with('success', 'Service supprimé avec succès.');
    }
}
