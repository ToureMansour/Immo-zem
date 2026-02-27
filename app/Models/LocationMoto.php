<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationMoto extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'locations_motos';

    protected $fillable = [
        'numero_location',
        'moto_id',
        'conducteur_id',
        'type_location',
        'date_debut',
        'date_fin',
        'duree_jours',
        'montant_total',
        'acompte',
        'reste_a_payer',
        'caution',
        'statut',
        'kilometrage_depart',
        'kilometrage_retour',
        'observations_depart',
        'observations_retour',
        'chemin_pdf_contrat',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'duree_jours' => 'integer',
        'montant_total' => 'decimal:2',
        'acompte' => 'decimal:2',
        'reste_a_payer' => 'decimal:2',
        'caution' => 'decimal:2',
        'kilometrage_depart' => 'integer',
        'kilometrage_retour' => 'integer',
    ];

    public function moto()
    {
        return $this->belongsTo(Moto::class);
    }

    public function conducteur()
    {
        return $this->belongsTo(Conducteur::class);
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

    public function estAnnulee()
    {
        return $this->statut === 'annulee';
    }

    public function getKilometrageParcouruAttribute()
    {
        if ($this->kilometrage_retour && $this->kilometrage_depart) {
            return $this->kilometrage_retour - $this->kilometrage_depart;
        }
        return null;
    }
}
