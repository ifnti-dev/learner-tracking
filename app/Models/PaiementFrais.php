<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaiementFrais extends Model
{

    protected $fillable = [
        'apprenant_niveau_id',
        'prise_en_charge',
        'montant',
        'verse',
        'piece_justificatif',
        'data',

    ];

    public function apprenantNiveau(): BelongsTo
    {
        return $this->belongsTo(ApprenantNiveau::class);
    }
    
}
