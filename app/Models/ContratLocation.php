<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContratLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contrats_location';

    protected $fillable = [
        'numero_contrat',
        'bien_immobilier_id',
        'locataire_id',
        'proprietaire_id',
        'date_debut',
        'date_fin',
        'loyer_mensuel',
        'caution',
        'charges_mensuelles',
        'frequence_paiement',
        'statut',
        'clauses_particulieres',
        'chemin_pdf_contrat',
        'date_signature',
    ];

    protected $casts = [
        'loyer_mensuel' => 'decimal:2',
        'caution' => 'decimal:2',
        'charges_mensuelles' => 'decimal:2',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_signature' => 'date',
    ];

    public function bienImmobilier()
    {
        return $this->belongsTo(BienImmobilier::class);
    }

    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function estActif()
    {
        return $this->statut === 'actif';
    }

    public function estTermine()
    {
        return $this->statut === 'termine';
    }
}
