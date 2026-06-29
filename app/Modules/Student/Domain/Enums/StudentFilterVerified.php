<?php

namespace App\Modules\Student\Domain\Enums;

enum StudentFilterVerified : string
{
    case ALL = 'ALL';
    case PENDING = 'PENDING';
    case VERIFIED = 'VERIFIED';
}