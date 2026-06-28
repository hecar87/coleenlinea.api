<?php

namespace App\Modules\SchoolClass\Domain\Enums;

enum SchoolClassStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}