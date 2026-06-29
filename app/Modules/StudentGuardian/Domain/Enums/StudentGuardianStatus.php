<?php

namespace App\Modules\StudentGuardian\Domain\Enums;

enum StudentGuardianStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}