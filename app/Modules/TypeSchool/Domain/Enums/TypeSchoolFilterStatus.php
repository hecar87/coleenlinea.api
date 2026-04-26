<?php

namespace App\Domain\TypeSchool\Enums;

enum TypeSchoolFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}