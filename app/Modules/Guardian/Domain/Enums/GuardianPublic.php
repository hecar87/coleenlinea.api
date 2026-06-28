<?php

namespace App\Modules\Guardian\Domain\Enums;

enum GuardianPublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}