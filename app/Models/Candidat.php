<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidat extends Model
{
    public function apprenant(): HasOne
    {
        return $this->hasOne(Apprenant::class);
    }
}
