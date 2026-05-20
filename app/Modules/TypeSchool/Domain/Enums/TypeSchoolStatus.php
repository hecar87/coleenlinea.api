<?php

namespace App\Modules\TypeSchool\Domain\Enums;

enum TypeSchoolStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}