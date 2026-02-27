<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BienImmobilier;
use App\Models\Moto;
use App\Models\ContratLocation;
use App\Models\LocationMoto;
use App\Models\Paiement;
use App\Models\Proprietaire;
use App\Models\Locataire;
use App\Models\Conducteur;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques immobilières
        $totalBiens = BienImmobilier::count();
        $biensDisponibles = BienImmobilier::where('statut', 'disponible')->count();
        $biensLoues = BienImmobilier::where('statut', 'loue')->count();
        
        $totalProprietaires = Proprietaire::count();
        $totalLocataires = Locataire::count();
        $contratsActifs = ContratLocation::where('statut', 'actif')->count();
        
        // Statistiques motos
        $totalMotos = Moto::count();
        $motosDisponibles = Moto::where('statut', 'disponible')->count();
        $motosLouees = Moto::where('statut', 'loue')->count();
        
        $totalConducteurs = Conducteur::count();
        $locationsActives = LocationMoto::where('statut', 'en_cours')->count();
        
        // Statistiques financières
        $loyersDuMois = Paiement::where('type_paiement', 'loyer_immo')
            ->whereMonth('date_echeance', now()->month)
            ->whereYear('date_echeance', now()->year)
            ->sum('montant');
            
        $loyersPayesMois = Paiement::where('type_paiement', 'loyer_immo')
            ->where('statut', 'paye')
            ->whereMonth('date_paiement', now()->month)
            ->whereYear('date_paiement', now()->year)
            ->sum('montant');
            
        $locationsMotosMois = Paiement::where('type_paiement', 'location_moto')
            ->where('statut', 'paye')
            ->whereMonth('date_paiement', now()->month)
            ->whereYear('date_paiement', now()->year)
            ->sum('montant');
            
        $paiementsEnRetard = Paiement::where('statut', 'en_retard')
            ->orWhere('statut', 'impaye')
            ->count();
        
        // Taux d'occupation
        $tauxOccupationImmo = $totalBiens > 0 ? round(($biensLoues / $totalBiens) * 100, 1) : 0;
        $tauxOccupationMotos = $totalMotos > 0 ? round(($motosLouees / $totalMotos) * 100, 1) : 0;
        
        // Activités récentes
        $contratsRecents = ContratLocation::with(['locataire', 'bienImmobilier'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $locationsRecentes = LocationMoto::with(['conducteur', 'moto'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard', compact([
            'totalBiens', 'biensDisponibles', 'biensLoues',
            'totalProprietaires', 'totalLocataires', 'contratsActifs',
            'totalMotos', 'motosDisponibles', 'motosLouees',
            'totalConducteurs', 'locationsActives',
            'loyersDuMois', 'loyersPayesMois', 'locationsMotosMois',
            'paiementsEnRetard', 'tauxOccupationImmo', 'tauxOccupationMotos',
            'contratsRecents', 'locationsRecentes'
        ]));
    }
}
