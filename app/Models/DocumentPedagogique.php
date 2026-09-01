<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentPedagogique extends Model
{
    public function emprunts(): BelongsToMany
    {
        return $this->belongsToMany(Emprunt::class);
    }
    public function document_pedagogique_emprunts(): HasMany
    {
        return $this->hasMany(DocumentPedagogiqueEmprunt::class);
    }
}
