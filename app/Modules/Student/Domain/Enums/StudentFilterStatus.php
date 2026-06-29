<?php

namespace App\Modules\Guardian\Domain\Enums;

enum GuardianFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}