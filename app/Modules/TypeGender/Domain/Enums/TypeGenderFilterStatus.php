<?php

namespace App\Domain\TypeGender\Enums;

enum TypeGenderFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}