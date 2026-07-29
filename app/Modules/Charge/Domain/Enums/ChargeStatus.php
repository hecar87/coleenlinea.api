<?php

namespace App\Modules\Charge\Domain\Enums;

enum ChargeStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}