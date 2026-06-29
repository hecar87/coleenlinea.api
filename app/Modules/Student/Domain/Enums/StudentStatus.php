<?php

namespace App\Modules\Student\Domain\Enums;

enum StudentStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}