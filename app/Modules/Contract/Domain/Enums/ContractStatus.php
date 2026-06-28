<?php

namespace App\Modules\Contract\Domain\Enums;

enum ContractStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
	case CLOSED = 6;
	case NULLIFIED = 9;
}