<?php

namespace App\Modules\SchoolLevel\Domain\Enums;

enum SchoolLevelStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}