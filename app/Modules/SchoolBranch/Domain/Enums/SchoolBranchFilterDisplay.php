<?php

namespace App\Modules\SchoolBranch\Domain\Enums;

enum SchoolBranchFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}