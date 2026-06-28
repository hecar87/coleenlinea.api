<?php

namespace App\Modules\Guardian\Domain\Enums;

enum GuardianFilterVerified : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}