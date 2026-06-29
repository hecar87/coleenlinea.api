<?php

namespace App\Modules\Student\Domain\Enums;

enum StudentVerified : int
{
	case PENDING = 1;
    case VERIFIED = 2;
}