<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Niveau extends Model
{
    public function apprenants(): BelongsToMany
    {
        return $this->belongsToMany(Apprenant::class,"apprenant_niveaux");
    }


    public function document_pedagogiques():HasMany{
        return $this->hasMany(DocumentPedagogique::class);
    }
    
}
