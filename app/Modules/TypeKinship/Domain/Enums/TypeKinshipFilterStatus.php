<?php

namespace App\Domain\TypeKinship\Enums;

enum TypeKinshipFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}