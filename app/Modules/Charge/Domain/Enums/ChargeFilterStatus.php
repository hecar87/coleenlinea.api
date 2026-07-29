<?php

namespace App\Modules\Charge\Domain\Enums;

enum ChargeFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}