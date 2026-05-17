<?php

namespace App\Modules\TypePopulation\Domain\Enums;

enum TypePopulationFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}