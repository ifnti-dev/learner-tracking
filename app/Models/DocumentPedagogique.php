<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentPedagogique extends Model
{
    protected $fillable = [
        'titre',
        'auteur',
        'quantite',
        'description',
        'niveau_id'

    ];
    public function emprunts(): BelongsToMany
    {
        return $this->belongsToMany(Emprunt::class,'document_pedagogique_emprunts');
    }
    public function document_pedagogique_emprunts(): HasMany
    {
        return $this->hasMany(DocumentPedagogiqueEmprunt::class);
    }

    public function niveau():BelongsTo{
        return $this->belongsTo(Niveau::class);
    }
}
