<?php

namespace App\Modules\StudentGuardian\Domain\Enums;

enum StudentGuardianFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}