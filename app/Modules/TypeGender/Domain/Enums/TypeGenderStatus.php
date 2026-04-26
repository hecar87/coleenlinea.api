<?php

namespace App\Domain\TypeGender\Enums;

enum TypeGenderStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}