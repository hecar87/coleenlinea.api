<?php

namespace App\Modules\EnrollmentInstallment\Domain\Enums;

enum EnrollmentInstallmentStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}