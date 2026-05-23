<?php

namespace App\Modules\State\Domain\Enums;

enum StatePublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}