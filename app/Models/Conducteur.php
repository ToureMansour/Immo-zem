<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conducteur extends Model
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
        'permis_numero',
        'permis_date_delivrance',
        'permis_lieu_delivrance',
        'permis_expiration',
        'statut',
        'notes',
    ];

    protected $casts = [
        'cni_date_delivrance' => 'date',
        'permis_date_delivrance' => 'date',
        'permis_expiration' => 'date',
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

    public function getFullNameAttribute()
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estActif()
    {
        return $this->statut === 'actif';
    }

    public function permisValide()
    {
        return $this->permis_expiration && $this->permis_expiration > now();
    }
}
