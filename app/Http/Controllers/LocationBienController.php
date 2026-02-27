<?php

namespace App\Http\Controllers;

use App\Models\LocationBien;
use App\Models\BienImmobilier;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class LocationBienController extends Controller
{
    public function index()
    {
        $locations = LocationBien::with(['bienImmobilier', 'locataire', 'proprietaire'])
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('locations_biens.index', compact('locations'));
    }

    public function create()
    {
        $biens = BienImmobilier::where('statut', 'disponible')->get();
        $proprietaires = Proprietaire::all();

        return view('locations_biens.create', compact('biens', 'proprietaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bien_immobilier_id' => 'required|exists:biens_immobiliers,id',
            'locataire_id' => 'required|exists:proprietaires,id',
            'proprietaire_id' => 'required|exists:proprietaires,id',
            'type_bail' => 'required|in:habitation,commercial,professionnel,meuble,non_meuble',
            'duree_mois' => 'required|integer|min:1|max:120',
            'date_debut' => 'required|date|after_or_equal:today',
            'montant_loyer_mensuel' => 'required|numeric|min:0',
            'charges_mensuelles' => 'required|numeric|min:0',
            'depot_garantie' => 'required|numeric|min:0',
            'loyer_premier_mois' => 'required|numeric|min:0',
            'observations_entree' => 'nullable|string',
            'etat_lieux_entre' => 'nullable|array',
        ]);

        $bien = BienImmobilier::findOrFail($request->bien_immobilier_id);
        
        // Calculer la date de fin
        $dateFin = date('Y-m-d', strtotime($request->date_debut . ' + ' . $request->duree_mois . ' months'));

        // Générer un numéro de location unique
        $numeroLocation = 'LOC-B-' . date('Y') . '-' . str_pad(LocationBien::count() + 1, 4, '0', STR_PAD_LEFT);

        $location = LocationBien::create([
            'numero_location' => $numeroLocation,
            'bien_immobilier_id' => $request->bien_immobilier_id,
            'locataire_id' => $request->locataire_id,
            'proprietaire_id' => $request->proprietaire_id,
            'type_bail' => $request->type_bail,
            'duree_mois' => $request->duree_mois,
            'date_debut' => $request->date_debut,
            'date_fin' => $dateFin,
            'montant_loyer_mensuel' => $request->montant_loyer_mensuel,
            'charges_mensuelles' => $request->charges_mensuelles,
            'depot_garantie' => $request->depot_garantie,
            'montant_total_garantie' => $request->depot_garantie + $request->loyer_premier_mois,
            'loyer_premier_mois' => $request->loyer_premier_mois,
            'statut' => 'en_cours',
            'observations_entree' => $request->observations_entree,
            'etat_lieux_entre' => $request->etat_lieux_entre ?? [],
        ]);

        // Mettre à jour le statut du bien
        $bien->update(['statut' => 'loue']);

        return redirect()->route('locations_biens.show', $location)
            ->with('success', 'Location de bien immobilier démarrée avec succès !');
    }

    public function show(LocationBien $location)
    {
        $location->load(['bienImmobilier', 'locataire', 'proprietaire', 'paiements']);
        return view('locations_biens.show', compact('location'));
    }

    public function edit(LocationBien $location)
    {
        $biens = BienImmobilier::all();
        $proprietaires = Proprietaire::all();
        
        return view('locations_biens.edit', compact('location', 'biens', 'proprietaires'));
    }

    public function update(Request $request, LocationBien $location)
    {
        $request->validate([
            'type_bail' => 'required|in:habitation,commercial,professionnel,meuble,non_meuble',
            'duree_mois' => 'required|integer|min:1|max:120',
            'date_debut' => 'required|date',
            'montant_loyer_mensuel' => 'required|numeric|min:0',
            'charges_mensuelles' => 'required|numeric|min:0',
            'depot_garantie' => 'required|numeric|min:0',
            'loyer_premier_mois' => 'required|numeric|min:0',
            'observations_entree' => 'nullable|string',
            'observations_sortie' => 'nullable|string',
            'etat_lieux_entre' => 'nullable|array',
            'etat_lieux_sortie' => 'nullable|array',
        ]);

        // Calculer la nouvelle date de fin
        $dateFin = date('Y-m-d', strtotime($request->date_debut . ' + ' . $request->duree_mois . ' months'));

        $location->update([
            'type_bail' => $request->type_bail,
            'duree_mois' => $request->duree_mois,
            'date_debut' => $request->date_debut,
            'date_fin' => $dateFin,
            'montant_loyer_mensuel' => $request->montant_loyer_mensuel,
            'charges_mensuelles' => $request->charges_mensuelles,
            'depot_garantie' => $request->depot_garantie,
            'montant_total_garantie' => $request->depot_garantie + $request->loyer_premier_mois,
            'loyer_premier_mois' => $request->loyer_premier_mois,
            'observations_entree' => $request->observations_entree,
            'observations_sortie' => $request->observations_sortie,
            'etat_lieux_entre' => $request->etat_lieux_entre ?? [],
            'etat_lieux_sortie' => $request->etat_lieux_sortie ?? [],
        ]);

        return redirect()->route('locations_biens.show', $location)
            ->with('success', 'Location mise à jour avec succès !');
    }

    public function destroy(LocationBien $location)
    {
        // Libérer le bien si était en cours de location
        if ($location->statut === 'en_cours') {
            $location->bienImmobilier->update(['statut' => 'disponible']);
        }

        $location->delete();

        return redirect()->route('locations_biens.index')
            ->with('success', 'Location supprimée avec succès !');
    }

    public function resilier(Request $request, LocationBien $location)
    {
        $request->validate([
            'date_resiliation' => 'required|date|after_or_equal:' . $location->date_debut,
            'motif_resiliation' => 'required|string',
            'observations_sortie' => 'nullable|string',
            'etat_lieux_sortie' => 'nullable|array',
        ]);

        $location->update([
            'statut' => 'resiliee',
            'date_resiliation' => $request->date_resiliation,
            'motif_resiliation' => $request->motif_resiliation,
            'observations_sortie' => $request->observations_sortie,
            'etat_lieux_sortie' => $request->etat_lieux_sortie ?? [],
        ]);

        // Libérer le bien
        $location->bienImmobilier->update(['statut' => 'disponible']);

        return redirect()->route('locations_biens.show', $location)
            ->with('success', 'Location résiliée avec succès !');
    }

    public function enregistrerPaiement(Request $request, LocationBien $location)
    {
        $request->validate([
            'montant_paiement' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'type_paiement' => 'required|in:loyer,charges,garantie',
        ]);

        $location->update([
            'date_derniere_paiement' => $request->date_paiement,
            'montant_dernier_paiement' => $request->montant_paiement,
        ]);

        return redirect()->route('locations_biens.show', $location)
            ->with('success', 'Paiement enregistré avec succès !');
    }
}
