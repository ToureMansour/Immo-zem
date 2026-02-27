<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
        'cni',
        'statut',
    ];

    protected $casts = [
        'statut' => 'string',
    ];

    public function biensImmobiliers()
    {
        return $this->hasMany(BienImmobilier::class);
    }

    public function parcelles()
    {
        return $this->hasMany(Parcelle::class);
    }

    public function contratsLocation()
    {
        return $this->hasMany(ContratLocation::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function getFullNameAttribute()
    {
        return $this->nom;
    }
}
