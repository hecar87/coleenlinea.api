<?php

namespace App\Modules\Student\Domain\Enums;

enum StudentPublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}