<?php

namespace App\Modules\Enrollment\Domain\Enums;

enum EnrollmentType : int
{
	case REPEATER = 1;
	case PROMOTED = 2;
}