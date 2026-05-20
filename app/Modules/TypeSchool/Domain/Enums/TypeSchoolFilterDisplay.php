<?php

namespace App\Modules\TypeSchool\Domain\Enums;

enum TypeSchoolFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}