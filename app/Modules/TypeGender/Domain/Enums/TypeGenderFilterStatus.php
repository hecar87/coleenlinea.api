<?php

namespace App\Modules\TypeGender\Domain\Enums;

enum TypeGenderFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}