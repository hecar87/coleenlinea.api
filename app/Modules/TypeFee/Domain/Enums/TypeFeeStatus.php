<?php

namespace App\Modules\TypeFee\Domain\Enums;

enum TypeFeeStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}