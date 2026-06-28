<?php

namespace App\Modules\Guardian\Domain\Enums;

enum GuardianVerified : int
{
	case PENDING = 1;
    case VERIFIED = 2;
}