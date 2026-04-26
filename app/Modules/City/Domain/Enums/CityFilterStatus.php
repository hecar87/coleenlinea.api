<?php

namespace App\Modules\City\Domain\Enums;

enum CityFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}