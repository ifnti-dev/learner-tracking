<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Niveau extends Model
{
    public function apprenants(): BelongsToMany
    {
        return $this->belongsToMany(Apprenant::class,"bulletins");
    }
    public function bulletins(): HasMany
    {
        return $this->hasMany(Bulletin::class);
    }
    public function paiementFrais(): HasMany
    {
        return $this->hasMany(PaiementFrais::class);
    }

    public function document_pedagogiques():HasMany{
        return $this->hasMany(DocumentPedagogique::class);
    }
    
}
