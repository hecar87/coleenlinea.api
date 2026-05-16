<?php

namespace App\Modules\TypeKinship\Domain\Enums;

enum TypeKinshipFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}