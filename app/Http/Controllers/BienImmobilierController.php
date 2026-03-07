<?php

namespace App\Http\Controllers;

use App\Models\BienImmobilier;
use Illuminate\Http\Request;

class BienImmobilierController extends Controller
{
    public function index()
    {
        $biens = BienImmobilier::latest()->paginate(5); 
        return view('biens.index', compact('biens'));
    }

    public function create()
    {
        return view('biens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_unique' => 'required|string|max:50|unique:biens_immobiliers,code_unique',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'type' => 'required|in:appartement,maison,studio,villa,commerce,terrain',
            'statut' => 'required|in:disponible,loue,en_maintenance,archive',
            'loyer_mensuel' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:0',
            'nombre_pieces' => 'nullable|integer|min:0',
            'caution' => 'nullable|numeric|min:0',
            'proprietaire_id' => 'required|exists:proprietaires,id',
            'date_disponibilite' => 'nullable|date',
            'equipements' => 'nullable|array',
            'equipements.*' => 'string|max:255',
        ]);

        $data = $request->all();
        $data['equipements'] = isset($data['equipements']) ? json_encode($data['equipements']) : null;

        BienImmobilier::create($data);

        return redirect()->route('biens.index')->with('success', 'Bien immobilier créé avec succès.');
    }

    public function show(BienImmobilier $bien)
    {
        return view('biens.show', compact('bien'));
    }

    public function edit(BienImmobilier $bien)
    {
        return view('biens.edit', compact('bien'));
    }

    public function update(Request $request, BienImmobilier $bien)
    {
        $request->validate([
            'code_unique' => 'required|string|max:50|unique:biens_immobiliers,code_unique,'.$bien->id,
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'required|string|max:255',
            'type' => 'required|in:appartement,maison,studio,villa,commerce,terrain',
            'statut' => 'required|in:disponible,loue,en_maintenance,archive',
            'loyer_mensuel' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:0',
            'nombre_pieces' => 'nullable|integer|min:0',
            'caution' => 'nullable|numeric|min:0',
            'proprietaire_id' => 'required|exists:proprietaires,id',
            'date_disponibilite' => 'nullable|date',
            'equipements' => 'nullable|array',
            'equipements.*' => 'string|max:255',
        ]);

        $data = $request->all();
        $data['equipements'] = isset($data['equipements']) ? json_encode($data['equipements']) : null;

        $bien->update($data);

        return redirect()->route('biens.index')->with('success', 'Bien immobilier mis à jour avec succès.');
    }

    public function destroy(BienImmobilier $bien)
    {
        $bien->delete();

        return redirect()->route('biens.index')->with('success', 'Bien immobilier supprimé avec succès.');
    }
}
