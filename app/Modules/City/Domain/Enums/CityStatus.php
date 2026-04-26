<?php

namespace App\Modules\City\Domain\Enums;

enum CityStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}