<?php

namespace App\Domain\TypeLevel\Enums;

enum TypeLevelStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}