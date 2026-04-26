<?php

namespace App\Domain\TypeLevel\Enums;

enum TypeLevelFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}