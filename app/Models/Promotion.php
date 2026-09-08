<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    protected $fillable = [
        "nom",
        "annee_creation",
        "date_limite",
        "est_active",
        "annee_id"
    ];
    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }
    public function apprenants(): HasMany
    {
        return $this->hasMany(Apprenant::class);
    } 

    public function annee():BelongsTo{
        return $this->belongsTo(Annee::class);
    }
}
