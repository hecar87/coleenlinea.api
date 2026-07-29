<?php

namespace App\Modules\School\Domain\Enums;

enum SchoolStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}