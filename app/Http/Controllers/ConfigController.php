<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    // Afficher la vue pour créer une nouvelle configuration
    public function create()
    {
        return view('configs.create'); // Indiquez le chemin de votre vue
    }

    // Index: Lire toutes les configurations et afficher la vue
    public function index()
    {
        $configs = Config::all();
        return view('configs.index', compact('configs')); // Renvoie à la vue index avec les configurations
    }

    // Store: Créer une nouvelle configuration et rediriger vers l'index
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pricevedette' => 'required|numeric',
            'priceconfidentialite' => 'required|numeric',
            'confidentialite' => 'nullable|string',
        ]);

        Config::create($validatedData);
        return redirect()->route('configs.index')->with('success', 'Configuration créée avec succès.');
    }

    // Show: Lire une configuration spécifique
    public function show($id)
    {
        $config = Config::find($id);
        if ($config) {
            return response()->json($config);
        } else {
            return response()->json(['message' => 'Config not found'], 404);
        }
    }

    // Update: Mettre à jour une configuration existante
    public function update(Request $request, $id)
    {
        $config = Config::find($id);
        if ($config) {
            $validatedData = $request->validate([
                'pricevedette' => 'sometimes|required|numeric',
                'priceconfidentialite' => 'sometimes|required|numeric',
                'confidentialite' => 'nullable|string',
            ]);

            $config->update($validatedData);
            return response()->json($config);
        } else {
            return response()->json(['message' => 'Config not found'], 404);
        }
    }

    // Destroy: Supprimer une configuration
    public function destroy($id)
    {
        $config = Config::find($id);
        if ($config) {
            $config->delete();
            return response()->json(['message' => 'Config deleted']);
        } else {
            return response()->json(['message' => 'Config not found'], 404);
        }
    }
}
