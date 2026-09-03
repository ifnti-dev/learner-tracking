<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprenantNiveau extends Model
{
    protected $fillable = [
        'apprenant_id',
        'niveau_id',
        'annee_id',
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function bulletins()
    {
        return $this->hasOne(Bulletin::class);
    }
    public function paiementFrais()
    {
        return $this->hasOne(PaiementFrais::class);
    }
}
