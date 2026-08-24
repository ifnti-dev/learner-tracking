<?php

namespace App\Enums;

enum Etat:string
{
    case PLANIFIER = 'PLANIFIER';
    case DEMARRER = 'DEMARRER';
    case TERMINER = 'TERMINER';
    case ANNULER = 'ANNULER';

}
