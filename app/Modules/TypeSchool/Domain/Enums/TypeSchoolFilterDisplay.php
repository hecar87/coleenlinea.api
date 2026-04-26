<?php

namespace App\Domain\TypeSchool\Enums;

enum TypeSchoolFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}