<?php

namespace App\Modules\Enrollment\Domain\Enums;

enum EnrollmentStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}