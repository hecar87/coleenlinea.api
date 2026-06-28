<?php

namespace App\Modules\SchoolInstallment\Domain\Enums;

enum SchoolInstallmentStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}