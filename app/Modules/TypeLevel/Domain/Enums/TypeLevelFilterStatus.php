<?php

namespace App\Modules\TypeLevel\Domain\Enums;

enum TypeLevelFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}