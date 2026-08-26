<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    protected $fillable = [
        'seance_id',
        'apprenant_id',
        'justification',
        'est_justifie',
    ];
    public function seance(): BelongsTo
    {
        return $this->belongsTo(Seance::class);
    }
     public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }
}
