<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ApprenantPersonneResponsable extends Model
{

    protected $fillable = [
        'personne_responsable_id',
        'apprenant_id'
    ];

    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class, 'apprenant_id');
    }


    public function personneResponsable(): BelongsTo
    {
        return $this->belongsTo(PersonneResponsable::class, 'personne_reponsable_id');
    }
}
