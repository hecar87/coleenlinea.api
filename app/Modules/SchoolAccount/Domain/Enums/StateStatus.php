<?php

namespace App\Modules\SchoolAccount\Domain\Enums;

enum SchoolAccountStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}