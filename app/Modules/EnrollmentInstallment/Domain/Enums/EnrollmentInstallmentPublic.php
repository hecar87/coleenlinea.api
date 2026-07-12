<?php

namespace App\Modules\EnrollmentInstallment\Domain\Enums;

enum EnrollmentInstallmentPublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}