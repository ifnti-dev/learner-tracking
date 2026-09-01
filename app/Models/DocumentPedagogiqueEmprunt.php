<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentPedagogiqueEmprunt extends Model
{
    public function document_pedagogique():BelongsTo{
        return $this->belongsTo(DocumentPedagogique::class);
    }

    public function emprunt():BelongsTo {
        return $this->belongsTo(Emprunt::class);
    }
}
