<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BienImmobilier extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'biens_immobiliers';

    protected $fillable = [
        'code_unique',
        'proprietaire_id',
        'titre',
        'type',
        'adresse',
        'surface',
        'nombre_pieces',
        'loyer_mensuel',
        'caution',
        'statut',
        'description',
        'equipements',
        'photos',
        'date_disponibilite',
    ];

    protected $casts = [
        'surface' => 'decimal:2',
        'loyer_mensuel' => 'decimal:2',
        'caution' => 'decimal:2',
        'equipements' => 'array',
        'photos' => 'array',
        'date_disponibilite' => 'date',
    ];

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }

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

    public function estDisponible()
    {
        return $this->statut === 'disponible';
    }

    public function estLoue()
    {
        return $this->statut === 'loue';
    }
}
