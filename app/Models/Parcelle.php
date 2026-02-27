<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcelle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code_parcelle',
        'proprietaire_id',
        'titre_foncier',
        'adresse',
        'surface',
        'statut_juridique',
        'type_terrain',
        'prix_achat',
        'date_achat',
        'prix_vente',
        'date_vente',
        'acheteur_id',
        'description',
        'documents_cadastraux',
        'photos',
    ];

    protected $casts = [
        'surface' => 'decimal:2',
        'prix_achat' => 'decimal:2',
        'prix_vente' => 'decimal:2',
        'date_achat' => 'date',
        'date_vente' => 'date',
        'documents_cadastraux' => 'array',
        'photos' => 'array',
    ];

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'proprietaire_id');
    }

    public function acheteur()
    {
        return $this->belongsTo(Proprietaire::class, 'acheteur_id');
    }

    public function estVendue()
    {
        return !is_null($this->date_vente) && !is_null($this->acheteur_id);
    }

    public function getStatutAfficheAttribute()
    {
        if ($this->estVendue()) {
            return 'Vendue';
        }
        
        return match($this->statut_juridique) {
            'propriete' => 'Propriété',
            'location' => 'Location',
            'copropriete' => 'Copropriété',
            default => $this->statut_juridique,
        };
    }

    public function getTypeTerrainAfficheAttribute()
    {
        return match($this->type_terrain) {
            'residentiel' => 'Résidentiel',
            'commercial' => 'Commercial',
            'agricole' => 'Agricole',
            'industriel' => 'Industriel',
            default => $this->type_terrain,
        };
    }
}
