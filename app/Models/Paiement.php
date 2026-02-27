<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference',
        'type_paiement',
        'contrat_location_id',
        'location_moto_id',
        'montant',
        'date_paiement',
        'date_echeance',
        'statut',
        'mode_paiement',
        'reference_transaction',
        'notes',
        'chemin_pdf_quittance',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_paiement' => 'date',
        'date_echeance' => 'date',
    ];

    public function contratLocation()
    {
        return $this->belongsTo(ContratLocation::class);
    }

    public function locationMoto()
    {
        return $this->belongsTo(LocationMoto::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function estPaye()
    {
        return $this->statut === 'paye';
    }

    public function estEnRetard()
    {
        return $this->statut === 'en_retard';
    }

    public function estEnAttente()
    {
        return $this->statut === 'en_attente';
    }

    public function scopeLoyersImmo($query)
    {
        return $query->where('type_paiement', 'loyer_immo');
    }

    public function scopeLocationsMotos($query)
    {
        return $query->where('type_paiement', 'location_moto');
    }

    public function scopeCaution($query)
    {
        return $query->where('type_paiement', 'caution');
    }

    public function scopeCharges($query)
    {
        return $query->where('type_paiement', 'charges');
    }
}
