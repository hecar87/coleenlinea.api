<?php

namespace App\Domain\TypeInstallment\Enums;

enum TypeInstallmentStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}