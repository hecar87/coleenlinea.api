<?php

namespace App\Modules\TypeCivil\Domain\Enums;

enum TypeCivilFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}