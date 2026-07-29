<?php

namespace App\Modules\Charge\Domain\Enums;

enum ChargePublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}