<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proprietaire;

class ProprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proprietaires = Proprietaire::latest()->paginate(5); 
        return view('proprietaires.index', compact('proprietaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proprietaires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:proprietaires,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'nullable|string',
            'statut' => 'required|in:actif,inactif',
            'cni_numero' => 'required|string|max:50',
            'cni_date_delivrance' => 'required|date',
            'cni_lieu_delivrance' => 'required|string|max:255',
        ]);

        Proprietaire::create($validated);

        return redirect()->route('proprietaires.index')
            ->with('success', 'Propriétaire créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proprietaire $proprietaire)
    {
        return view('proprietaires.show', compact('proprietaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proprietaire $proprietaire)
    {
        return view('proprietaires.edit', compact('proprietaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proprietaire $proprietaire)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:proprietaires,email,'.$proprietaire->id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'nullable|string',
            'statut' => 'required|in:actif,inactif',
            'cni_numero' => 'required|string|max:50',
            'cni_date_delivrance' => 'required|date',
            'cni_lieu_delivrance' => 'required|string|max:255',
        ]);

        $proprietaire->update($validated);

        return redirect()->route('proprietaires.index')
            ->with('success', 'Propriétaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proprietaire $proprietaire)
    {
        $proprietaire->delete();

        return redirect()->route('proprietaires.index')
            ->with('success', 'Propriétaire supprimé avec succès.');
    }
}
