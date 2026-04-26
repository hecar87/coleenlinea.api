<?php

namespace App\Domain\TypeLevel\Enums;

enum TypeLevelFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}