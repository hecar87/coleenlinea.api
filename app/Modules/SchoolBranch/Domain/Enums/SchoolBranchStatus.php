<?php

namespace App\Modules\SchoolBranch\Domain\Enums;

enum SchoolBranchStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}