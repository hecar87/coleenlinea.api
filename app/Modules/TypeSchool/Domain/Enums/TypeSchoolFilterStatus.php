<?php

namespace App\Modules\TypeSchool\Domain\Enums;

enum TypeSchoolFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}