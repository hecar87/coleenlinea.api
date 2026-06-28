<?php

namespace App\Modules\SchoolYear\Domain\Enums;

enum SchoolYearStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}