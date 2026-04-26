<?php

namespace App\Domain\TypeFee\Enums;

enum TypeFeeStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}