<?php

namespace App\Modules\TypeCivil\Domain\Enums;

enum TypeCivilFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}