<?php

namespace App\Domain\District\Enums;

enum DistrictStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}