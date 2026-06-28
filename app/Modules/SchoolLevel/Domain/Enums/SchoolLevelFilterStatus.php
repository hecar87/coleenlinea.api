<?php

namespace App\Modules\SchoolLevel\Domain\Enums;

enum SchoolLevelFilterStatus : string
{
    case ALL = "ALL";
    case ACTIVE = "ACTIVE";
    case INACTIVE = "INACTIVE";
}