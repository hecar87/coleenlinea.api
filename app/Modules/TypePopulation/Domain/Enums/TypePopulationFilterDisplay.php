<?php

namespace App\Modules\TypePopulation\Domain\Enums;

enum TypePopulationFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}