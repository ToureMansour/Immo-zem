<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use Illuminate\Http\Request;

class MotoController extends Controller
{
    public function index()
    {
        $motos = Moto::latest()->paginate(5); 
        return view('motos.index', compact('motos'));
    }

    public function create()
    {
        return view('motos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'immatriculation' => 'required|string|max:50|unique:motos,immatriculation',
            'marque' => 'required|string|max:100',
            'modele' => 'required|string|max:100',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'couleur' => 'required|string|max:50',
            'type_moto' => 'required|in:taxi,personnel,livraison',
            'prix_journalier' => 'required|numeric|min:0',
            'prix_avec_credit' => 'required|numeric|min:0',
            'prix_location_vente' => 'required|numeric|min:0',
            'statut' => 'required|in:disponible,loue,reparation,hors_service',
            'kilometrage' => 'required|integer|min:0',
            'date_derniere_maintenance' => 'nullable|date',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'string|max:255',
            'carte_grise_numero' => 'required|string|max:50|unique:motos,carte_grise_numero',
            'carte_grise_delivrance' => 'required|date',
        ]);

        $data = $request->all();
        $data['photos'] = isset($data['photos']) ? json_encode($data['photos']) : null;

        Moto::create($data);

        return redirect()->route('motos.index')->with('success', 'Moto créée avec succès.');
    }

    public function show(Moto $moto)
    {
        return view('motos.show', compact('moto'));
    }

    public function edit(Moto $moto)
    {
        return view('motos.edit', compact('moto'));
    }

    public function update(Request $request, Moto $moto)
    {
        $request->validate([
            'immatriculation' => 'required|string|max:50|unique:motos,immatriculation,'.$moto->id,
            'marque' => 'required|string|max:100',
            'modele' => 'required|string|max:100',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'couleur' => 'required|string|max:50',
            'type_moto' => 'required|in:taxi,personnel,livraison',
            'prix_journalier' => 'required|numeric|min:0',
            'prix_avec_credit' => 'required|numeric|min:0',
            'prix_location_vente' => 'required|numeric|min:0',
            'statut' => 'required|in:disponible,loue,reparation,hors_service',
            'kilometrage' => 'required|integer|min:0',
            'date_derniere_maintenance' => 'nullable|date',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'string|max:255',
            'carte_grise_numero' => 'required|string|max:50|unique:motos,carte_grise_numero,'.$moto->id,
            'carte_grise_delivrance' => 'required|date',
        ]);

        $data = $request->all();
        $data['photos'] = isset($data['photos']) ? json_encode($data['photos']) : null;

        $moto->update($data);

        return redirect()->route('motos.index')->with('success', 'Moto mise à jour avec succès.');
    }

    public function destroy(Moto $moto)
    {
        $moto->delete();

        return redirect()->route('motos.index')->with('success', 'Moto supprimée avec succès.');
    }
}
