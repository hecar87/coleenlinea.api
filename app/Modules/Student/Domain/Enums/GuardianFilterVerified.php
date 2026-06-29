<?php

namespace App\Modules\Guardian\Domain\Enums;

enum GuardianFilterVerified : string
{
    case ALL = 'ALL';
    case PENDING = 'PENDING';
    case VERIFIED = 'VERIFIED';
}