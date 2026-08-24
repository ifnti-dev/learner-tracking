<?php

namespace App\Models;

use App\Enums\Etat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seance extends Model
{
    protected $fillable = [
        'intitule',
        'description',
        'heure_debut',
        'heure_fin',
        'date',
        'type_seance',
        'etat',
        'utilisateur_id',
        'promotion_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function promotion(): belongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }
    public function estTerminer(): bool
    {
        return $this->etat == Etat::TERMINER;
    }
}
