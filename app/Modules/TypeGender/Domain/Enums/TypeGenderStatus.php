<?php

namespace App\Modules\TypeGender\Domain\Enums;

enum TypeGenderStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}