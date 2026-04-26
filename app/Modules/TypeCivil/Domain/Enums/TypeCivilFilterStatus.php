<?php

namespace App\Domain\TypeCivil\Enums;

enum TypeCivilFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}