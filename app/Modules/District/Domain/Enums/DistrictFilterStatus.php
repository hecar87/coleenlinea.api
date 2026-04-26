<?php

namespace App\Modules\District\Domain\Enums;

enum DistrictFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}