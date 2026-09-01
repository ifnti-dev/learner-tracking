<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bulletin extends Model

{
    protected $fillable = [
        'bulletin1',
        'bulletin2',
        'bulletin3',
        'bulletin4',
        'bulletin5',
        'data1',
        'data2',
        'data3',
        'data4',
        'data5',
        "niveau_id",
        "apprenant_id",
        "status",
        'annee_scolaire'
    ];
    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(Apprenant::class);
    }
    public function niveau(): BelongsTo
    {
        return $this->belongsTo(Niveau::class);
    }
}
