<?php

namespace App\Modules\District\Domain\Enums;

enum DistrictStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}