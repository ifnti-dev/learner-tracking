<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidat extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'sexe',
        'adresse',
        'date_naissance',
        'etablissement',
        'promotion_id',
       "niveau_de_base",
    ];

    public function apprenant(): HasOne
    {
        return $this->hasOne(Apprenant::class);
    }
}
