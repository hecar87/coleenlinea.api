<?php

namespace App\Domain\TypePopulation\Enums;

enum TypePopulationFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}