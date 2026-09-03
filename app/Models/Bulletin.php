<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bulletin extends Model

{
    protected $fillable = [
        'apprenant_niveau_id',
        'bulletin1',
        'bulletin2',
        'bulletin3',
        'releveCEPD',
        'releveBEPC',
        'releveBAC1',
        'releveBAC2',
        'dataCEPD',
        'dataBEPC',
        'dataBAC1',
        'dataBAC2',

        "status",

    ];
    public function apprenantNiveau(): BelongsTo
    {
        return $this->belongsTo(ApprenantNiveau::class);
    }


}
