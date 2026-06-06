<?php

namespace App\Modules\SchoolBranch\Domain\Enums;

enum SchoolBranchFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}