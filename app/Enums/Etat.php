<?php

namespace App\Enums;

enum Etat:string
{
    case PLANIFIER = 'PLANIFIER';
    case ENCOURS = 'ENCOURS';
    case TERMINER = 'TERMINER';
    case ANNULER = 'ANNULER';

}
