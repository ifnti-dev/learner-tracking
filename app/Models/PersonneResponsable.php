<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PersonneResponsable extends Model
{
    public function apprenants(): BelongsToMany
    {
        return $this->belongsToMany(Apprenant::class);
    }
}
