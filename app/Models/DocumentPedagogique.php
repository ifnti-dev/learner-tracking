<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DocumentPedagogique extends Model
{
    public function emprunts():BelongsToMany
    {
        return $this->belongsToMany(Emprunt::class);
    }
}
