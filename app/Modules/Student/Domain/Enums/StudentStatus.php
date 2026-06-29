<?php

namespace App\Modules\Guardian\Domain\Enums;

enum GuardianStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}