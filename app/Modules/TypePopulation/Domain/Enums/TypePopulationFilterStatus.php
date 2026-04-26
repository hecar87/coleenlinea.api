<?php

namespace App\Domain\TypePopulation\Enums;

enum TypePopulationFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}