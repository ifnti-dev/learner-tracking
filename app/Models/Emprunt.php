<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
