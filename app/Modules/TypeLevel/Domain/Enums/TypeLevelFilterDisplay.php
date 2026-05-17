<?php

namespace App\Modules\TypeLevel\Domain\Enums;

enum TypeLevelFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}