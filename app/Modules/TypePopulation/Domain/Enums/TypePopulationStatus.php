<?php

namespace App\Modules\TypePopulation\Domain\Enums;

enum TypePopulationStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}