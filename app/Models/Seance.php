<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seance extends Model
{
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
    
}
