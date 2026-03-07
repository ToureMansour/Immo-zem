<?php

namespace App\Http\Controllers;

use App\Models\Parcelle;
use Illuminate\Http\Request;

class ParcelleController extends Controller
{
    public function index()
    {
        $parcelles = Parcelle::latest()->paginate(5); 
        return view('parcelles.index', compact('parcelles'));
    }

    public function create()
    {
        return view('parcelles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_parcelle' => 'required|string|max:50|unique:parcelles,code_parcelle',
            'titre_foncier' => 'required|string|max:100|unique:parcelles,titre_foncier',
            'adresse' => 'required|string|max:255',
            'surface' => 'required|numeric|min:0',
            'statut_juridique' => 'required|in:propriete,location,copropriete',
            'type_terrain' => 'required|in:residentiel,commercial,agricole,industriel',
            'prix_achat' => 'nullable|numeric|min:0',
            'date_achat' => 'nullable|date',
            'prix_vente' => 'nullable|numeric|min:0',
            'date_vente' => 'nullable|date',
            'proprietaire_id' => 'required|exists:proprietaires,id',
            'acheteur_id' => 'nullable|exists:proprietaires,id',
            'description' => 'nullable|string',
            'documents_cadastraux' => 'nullable|array',
            'documents_cadastraux.*' => 'string|max:255',
            'photos' => 'nullable|array',
            'photos.*' => 'string|max:255',
        ]);

        $data = $request->all();
        $data['documents_cadastraux'] = isset($data['documents_cadastraux']) ? json_encode($data['documents_cadastraux']) : null;
        $data['photos'] = isset($data['photos']) ? json_encode($data['photos']) : null;

        Parcelle::create($data);

        return redirect()->route('parcelles.index')->with('success', 'Parcelle créée avec succès.');
    }

    public function show(Parcelle $parcelle)
    {
        return view('parcelles.show', compact('parcelle'));
    }

    public function edit(Parcelle $parcelle)
    {
        return view('parcelles.edit', compact('parcelle'));
    }

    public function update(Request $request, Parcelle $parcelle)
    {
        $request->validate([
            'code_parcelle' => 'required|string|max:50|unique:parcelles,code_parcelle,'.$parcelle->id,
            'titre_foncier' => 'required|string|max:100|unique:parcelles,titre_foncier,'.$parcelle->id,
            'adresse' => 'required|string|max:255',
            'surface' => 'required|numeric|min:0',
            'statut_juridique' => 'required|in:propriete,location,copropriete',
            'type_terrain' => 'required|in:residentiel,commercial,agricole,industriel',
            'prix_achat' => 'nullable|numeric|min:0',
            'date_achat' => 'nullable|date',
            'prix_vente' => 'nullable|numeric|min:0',
            'date_vente' => 'nullable|date',
            'proprietaire_id' => 'required|exists:proprietaires,id',
            'acheteur_id' => 'nullable|exists:proprietaires,id',
            'description' => 'nullable|string',
            'documents_cadastraux' => 'nullable|array',
            'documents_cadastraux.*' => 'string|max:255',
            'photos' => 'nullable|array',
            'photos.*' => 'string|max:255',
        ]);

        $data = $request->all();
        $data['documents_cadastraux'] = isset($data['documents_cadastraux']) ? json_encode($data['documents_cadastraux']) : null;
        $data['photos'] = isset($data['photos']) ? json_encode($data['photos']) : null;

        $parcelle->update($data);

        return redirect()->route('parcelles.index')->with('success', 'Parcelle mise à jour avec succès.');
    }

    public function destroy(Parcelle $parcelle)
    {
        $parcelle->delete();

        return redirect()->route('parcelles.index')->with('success', 'Parcelle supprimée avec succès.');
    }
}
