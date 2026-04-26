<?php

namespace App\Domain\TypeKinship\Enums;

enum TypeKinshipFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}