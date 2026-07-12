<?php

namespace App\Modules\EnrollmentInstallment\Domain\Enums;

enum EnrollmentInstallmentPaid : int
{
	case PENDING = 1;
	case PAID = 2;
}