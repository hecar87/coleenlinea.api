<?php

namespace App\Domain\TypeKinship\Enums;

enum TypeKinshipStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}