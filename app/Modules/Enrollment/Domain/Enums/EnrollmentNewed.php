<?php

namespace App\Modules\Enrollment\Domain\Enums;

enum EnrollmentNewed : int
{
	case REGULAR = 1;
	case NEW = 2;
}