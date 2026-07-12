<?php

namespace App\Modules\EnrollmentInstallment\Domain\Enums;

enum EnrollmentInstallmentRequired : int
{
	case OPTIONAL = 1;
	case REQUIRED = 2;
}