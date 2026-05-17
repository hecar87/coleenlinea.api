<?php

namespace App\Modules\TypeLevel\Domain\Enums;

enum TypeLevelStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}