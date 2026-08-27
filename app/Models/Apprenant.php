<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apprenant extends Model
{

    protected $fillable = [
        'nom'    ,            
        'prenom'     ,        
        'telephone'         , 
        'email'              ,
        'sexe'               ,
        'adresse'            ,
        'date_naissance'     ,
        'etablissement'     ,
        'promotion_id'     ,
        'etablissement',
    ];

    public function promotion(): belongsTo
    {
        return $this->belongsTo(Promotion::class);
    }
    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class);
    }
    public function bulletins(): HasMany
    {
        return $this->hasMany(Bulletin::class);
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }
    public function candidat(): BelongsTo
    {
        return $this->belongsTo(Candidat::class);
    }

    public function personneResponsables(): BelongsToMany
    {
        return $this->belongsToMany(PersonneResponsable::class,'apprenant_personne_responsables');
    }
    public function niveaux(): BelongsToMany
    {
        return $this->belongsToMany(Niveau::class,'bulletins');
    }
    public function paiementFrais(): HasMany
    {
        return $this->hasMany(PaiementFrais::class);
    }
}
