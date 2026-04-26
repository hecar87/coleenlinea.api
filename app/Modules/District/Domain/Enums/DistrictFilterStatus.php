<?php

namespace App\Domain\District\Enums;

enum DistrictFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}