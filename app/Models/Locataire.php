<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locataire extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'adresse',
        'cni_numero',
        'cni_date_delivrance',
        'cni_lieu_delivrance',
        'profession',
        'salaire_mensuel',
        'personne_reference_nom',
        'personne_reference_telephone',
        'statut',
        'notes',
    ];

    protected $casts = [
        'salaire_mensuel' => 'decimal:2',
        'cni_date_delivrance' => 'date',
    ];

    public function contratsLocation()
    {
        return $this->hasMany(ContratLocation::class);
    }

    public function contratActif()
    {
        return $this->hasOne(ContratLocation::class)
            ->where('statut', 'actif')
            ->latest();
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function getFullNameAttribute()
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estActif()
    {
        return $this->statut === 'actif';
    }
}
