<?php

namespace App\Modules\State\Domain\Enums;

enum StateStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}