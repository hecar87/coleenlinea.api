<?php

namespace App\Domain\TypeCivil\Enums;

enum TypeCivilFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}