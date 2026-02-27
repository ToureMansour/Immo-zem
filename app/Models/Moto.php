<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moto extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'immatriculation',
        'marque',
        'modele',
        'annee',
        'couleur',
        'type_moto',
        'prix_journalier',
        'prix_avec_credit',
        'prix_location_vente',
        'statut',
        'kilometrage',
        'date_derniere_maintenance',
        'description',
        'photos',
        'carte_grise_numero',
        'carte_grise_delivrance',
    ];

    protected $casts = [
        'prix_journalier' => 'decimal:2',
        'prix_avec_credit' => 'decimal:2',
        'prix_location_vente' => 'decimal:2',
        'kilometrage' => 'integer',
        'date_derniere_maintenance' => 'date',
        'carte_grise_delivrance' => 'date',
        'photos' => 'array',
    ];

    public function locationsMotos()
    {
        return $this->hasMany(LocationMoto::class);
    }

    public function locationActuelle()
    {
        return $this->hasOne(LocationMoto::class)
            ->where('statut', 'en_cours')
            ->latest();
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function estDisponible()
    {
        return $this->statut === 'disponible';
    }

    public function estLouee()
    {
        return $this->statut === 'loue';
    }

    public function estEnReparation()
    {
        return $this->statut === 'reparation';
    }

    public function estHorsService()
    {
        return $this->statut === 'hors_service';
    }
}
