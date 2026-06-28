<?php

namespace App\Modules\Guardian\Domain\Enums;

enum GuardianVerified : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}