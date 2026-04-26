<?php

namespace App\Domain\TypeGender\Enums;

enum TypeGenderFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}