<?php

namespace App\Domain\State\Enums;

enum StatePublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}