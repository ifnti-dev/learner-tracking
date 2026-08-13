<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    public function seance(): BelongsTo
    {
        return $this->belongsTo(Seance::class);
    }
     public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }
}
