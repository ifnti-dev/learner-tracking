<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    protected $fillable = [
        "nom",
        "annee_creation"
    ];
    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }
    public function apprenants(): HasMany
    {
        return $this->hasMany(Apprenant::class);
    }
}
