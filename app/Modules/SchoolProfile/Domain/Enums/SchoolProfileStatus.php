<?php

namespace App\Modules\SchoolProfile\Domain\Enums;

enum SchoolProfileStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}