<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaiementFrais extends Model
{

    protected $fillable = [
        'apprenant_id',
        'niveau_id',
        'prise_en_charge',
        'montant',
        'verse',
        'piece_justificatif',
        'data',
    ];

    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }
    public function niveau(): BelongsTo
    {
        return $this->belongsTo(Niveau::class);
    }
}
