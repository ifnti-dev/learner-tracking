<?php

namespace App\Models;

use HashContext;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Emprunt extends Model
{
    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }
    public function documentPedagogiques(): BelongsToMany
    {
        return $this->belongsToMany(DocumentPedagogique::class);
    }

    public function document_pedagogique_emprunts():HasMany{
        return $this->hasMany(DocumentPedagogiqueEmprunt::class);
    }
}
