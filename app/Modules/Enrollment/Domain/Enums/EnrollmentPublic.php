<?php

namespace App\Modules\Enrollment\Domain\Enums;

enum EnrollmentPublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}