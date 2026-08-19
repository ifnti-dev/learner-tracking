<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PersonneResponsable extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'type',
    ];
    public function apprenants(): BelongsToMany
    {
        return $this->belongsToMany(Apprenant::class);
    }
}
