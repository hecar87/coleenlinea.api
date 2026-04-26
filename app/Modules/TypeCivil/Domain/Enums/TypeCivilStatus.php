<?php

namespace App\Domain\TypeCivil\Enums;

enum TypeCivilStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}