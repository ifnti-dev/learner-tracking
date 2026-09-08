<?php

namespace App\Models;

use HashContext;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Emprunt extends Model
{
      protected $fillable = [
        'date_emprunt',
        'date_restitution',
        'date_restitution_prevue',
        'est_restitue',
        'apprenant_id',
    ];
    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }
    public function document_pedagogiques(): BelongsToMany
    {
    return $this->belongsToMany(DocumentPedagogique::class, 'document_pedagogique_emprunts');
    }
    public function document_pedagogique_emprunts():HasMany{
        return $this->hasMany(DocumentPedagogiqueEmprunt::class);
    }
}
