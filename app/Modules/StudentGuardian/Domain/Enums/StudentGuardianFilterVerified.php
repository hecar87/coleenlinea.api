<?php

namespace App\Modules\StudentGuardian\Domain\Enums;

enum StudentGuardianFilterVerified : string
{
    case ALL = 'ALL';
    case PENDING = 'PENDING';
    case VERIFIED = 'VERIFIED';
}