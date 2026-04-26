<?php

namespace App\Domain\TypeBank\Enums;

enum TypeBankStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}