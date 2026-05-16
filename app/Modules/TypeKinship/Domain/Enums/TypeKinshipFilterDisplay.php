<?php

namespace App\Modules\TypeKinship\Domain\Enums;

enum TypeKinshipFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}