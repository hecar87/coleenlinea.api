<?php

namespace App\Modules\StudentGuardian\Domain\Enums;

enum StudentGuardianVerified : int
{
	case PENDING = 1;
    case VERIFIED = 2;
}