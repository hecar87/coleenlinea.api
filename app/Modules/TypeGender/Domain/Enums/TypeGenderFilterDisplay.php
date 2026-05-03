<?php

namespace App\Modules\TypeGender\Domain\Enums;

enum TypeGenderFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}