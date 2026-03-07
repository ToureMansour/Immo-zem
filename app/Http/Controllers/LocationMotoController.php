<?php

namespace App\Http\Controllers;

use App\Models\LocationMoto;
use App\Models\Moto;
use App\Models\Conducteur;
use Illuminate\Http\Request;

class LocationMotoController extends Controller
{
    public function index()
    {
        $locations = LocationMoto::with(['moto', 'conducteur'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('locations_motos.index', compact('locations'));
    }

    public function create()
    {
        $motos = Moto::where('statut', 'disponible')->get();
        $conducteurs = Conducteur::all();

        return view('locations_motos.create', compact('motos', 'conducteurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'moto_id' => 'required|exists:motos,id',
            'conducteur_id' => 'required|exists:conducteurs,id',
            'type_location' => 'required|in:journaliere,hebdomadaire,mensuelle,credit_bail',
            'date_debut' => 'required|date|after_or_equal:today',
            'duree_jours' => 'required|integer|min:1',
            'caution' => 'required|numeric|min:0',
            'acompte' => 'required|numeric|min:0',
            'kilometrage_depart' => 'required|integer|min:0',
            'observations_depart' => 'nullable|string',
        ]);

        $moto = Moto::findOrFail($request->moto_id);
        
        // Calculer le montant total selon le type de location
        $montantTotal = $this->calculerMontantTotal($request->type_location, $request->duree_jours, $moto);
        
        // Calculer la date de fin
        $dateFin = date('Y-m-d', strtotime($request->date_debut . ' + ' . $request->duree_jours . ' days'));

        // Générer un numéro de location unique
        $numeroLocation = 'LOC-' . date('Y') . '-' . str_pad(LocationMoto::count() + 1, 4, '0', STR_PAD_LEFT);

        $location = LocationMoto::create([
            'numero_location' => $numeroLocation,
            'moto_id' => $request->moto_id,
            'conducteur_id' => $request->conducteur_id,
            'type_location' => $request->type_location,
            'date_debut' => $request->date_debut,
            'date_fin' => $dateFin,
            'duree_jours' => $request->duree_jours,
            'montant_total' => $montantTotal,
            'acompte' => $request->acompte,
            'reste_a_payer' => $montantTotal - $request->acompte,
            'caution' => $request->caution,
            'statut' => 'en_cours',
            'kilometrage_depart' => $request->kilometrage_depart,
            'observations_depart' => $request->observations_depart,
        ]);

        // Mettre à jour le statut de la moto
        $moto->update(['statut' => 'loue']);

        return redirect()->route('locations_motos.show', $location)
            ->with('success', 'Location de moto démarrée avec succès !');
    }

    public function show(LocationMoto $location)
    {
        $location->load(['moto', 'conducteur', 'paiements']);
        return view('locations_motos.show', compact('location'));
    }

    public function edit(LocationMoto $location)
    {
        $motos = Moto::all();
        $conducteurs = Conducteur::all();
        
        return view('locations_motos.edit', compact('location', 'motos', 'conducteurs'));
    }

    public function update(Request $request, LocationMoto $location)
    {
        $request->validate([
            'type_location' => 'required|in:journaliere,hebdomadaire,mensuelle,credit_bail',
            'date_debut' => 'required|date',
            'duree_jours' => 'required|integer|min:1',
            'caution' => 'required|numeric|min:0',
            'acompte' => 'required|numeric|min:0',
            'kilometrage_depart' => 'required|integer|min:0',
            'kilometrage_retour' => 'nullable|integer|min:0',
            'observations_depart' => 'nullable|string',
            'observations_retour' => 'nullable|string',
        ]);

        $moto = Moto::findOrFail($location->moto_id);
        
        // Recalculer le montant total
        $montantTotal = $this->calculerMontantTotal($request->type_location, $request->duree_jours, $moto);
        
        // Calculer la nouvelle date de fin
        $dateFin = date('Y-m-d', strtotime($request->date_debut . ' + ' . $request->duree_jours . ' days'));

        $location->update([
            'type_location' => $request->type_location,
            'date_debut' => $request->date_debut,
            'date_fin' => $dateFin,
            'duree_jours' => $request->duree_jours,
            'montant_total' => $montantTotal,
            'acompte' => $request->acompte,
            'reste_a_payer' => $montantTotal - $request->acompte,
            'caution' => $request->caution,
            'kilometrage_depart' => $request->kilometrage_depart,
            'kilometrage_retour' => $request->kilometrage_retour,
            'observations_depart' => $request->observations_depart,
            'observations_retour' => $request->observations_retour,
        ]);

        return redirect()->route('locations_motos.show', $location)
            ->with('success', 'Location mise à jour avec succès !');
    }

    public function destroy(LocationMoto $location)
    {
        // Libérer la moto si elle était en cours de location
        if ($location->statut === 'en_cours') {
            $location->moto->update(['statut' => 'disponible']);
        }

        $location->delete();

        return redirect()->route('locations_motos.index')
            ->with('success', 'Location supprimée avec succès !');
    }

    public function terminer(LocationMoto $location)
    {
        $request = request();
        
        $request->validate([
            'kilometrage_retour' => 'required|integer|min:' . $location->kilometrage_depart,
            'observations_retour' => 'nullable|string',
        ]);

        $location->update([
            'statut' => 'terminee',
            'kilometrage_retour' => $request->kilometrage_retour,
            'observations_retour' => $request->observations_retour,
        ]);

        // Libérer la moto
        $location->moto->update(['statut' => 'disponible']);

        return redirect()->route('locations_motos.show', $location)
            ->with('success', 'Location terminée avec succès !');
    }

    private function calculerMontantTotal($typeLocation, $dureeJours, $moto)
    {
        $prixJournalier = $moto->prix_journalier;

        switch ($typeLocation) {
            case 'journaliere':
                return $prixJournalier * $dureeJours;
            case 'hebdomadaire':
                return $prixJournalier * 7 * $dureeJours;
            case 'mensuelle':
                return $prixJournalier * 30 * $dureeJours;
            case 'credit_bail':
                return $moto->prix_location_vente * $dureeJours;
            default:
                return $prixJournalier * $dureeJours;
        }
    }
}
