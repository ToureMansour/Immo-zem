<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationBien extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'locations_biens';

    protected $fillable = [
        'numero_location',
        'bien_immobilier_id',
        'locataire_id',
        'proprietaire_id',
        'type_bail',
        'duree_mois',
        'date_debut',
        'date_fin',
        'montant_loyer_mensuel',
        'charges_mensuelles',
        'depot_garantie',
        'montant_total_garantie',
        'loyer_premier_mois',
        'statut',
        'date_derniere_paiement',
        'montant_dernier_paiement',
        'observations_entree',
        'observations_sortie',
        'etat_lieux_entree',
        'etat_lieux_sortie',
        'chemin_pdf_contrat',
        'date_resiliation',
        'motif_resiliation',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_derniere_paiement' => 'date',
        'date_resiliation' => 'date',
        'duree_mois' => 'integer',
        'montant_loyer_mensuel' => 'decimal:2',
        'charges_mensuelles' => 'decimal:2',
        'depot_garantie' => 'decimal:2',
        'montant_total_garantie' => 'decimal:2',
        'loyer_premier_mois' => 'decimal:2',
        'montant_dernier_paiement' => 'decimal:2',
        'etat_lieux_entree' => 'array',
        'etat_lieux_sortie' => 'array',
    ];

    public function bienImmobilier()
    {
        return $this->belongsTo(BienImmobilier::class);
    }

    public function locataire()
    {
        return $this->belongsTo(Proprietaire::class, 'locataire_id');
    }

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'proprietaire_id');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function estEnCours()
    {
        return $this->statut === 'en_cours';
    }

    public function estTerminee()
    {
        return $this->statut === 'terminee';
    }

    public function estResiliee()
    {
        return $this->statut === 'resiliee';
    }

    public function estEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    public function getLoyerTotalMensuelAttribute()
    {
        return $this->montant_loyer_mensuel + $this->charges_mensuelles;
    }

    public function getMontantTotalContratAttribute()
    {
        return ($this->loyer_total_mensuel * $this->duree_mois) + $this->depot_garantie;
    }

    public function getMoisRestantsAttribute()
    {
        if (!$this->date_fin) return 0;
        
        $dateFin = \Carbon\Carbon::parse($this->date_fin);
        $aujourdHui = \Carbon\Carbon::now();
        
        if ($aujourdHui > $dateFin) return 0;
        
        return $aujourdHui->diffInMonths($dateFin) + 1;
    }

    public function getEnRetardAttribute()
    {
        if (!$this->date_derniere_paiement) return false;
        
        $dateDernierPaiement = \Carbon\Carbon::parse($this->date_derniere_paiement);
        $aujourdHui = \Carbon\Carbon::now();
        
        return $aujourdHui->diffInDays($dateDernierPaiement) > 30;
    }
}
