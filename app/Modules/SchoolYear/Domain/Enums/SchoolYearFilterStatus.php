<?php

namespace App\Modules\SchoolYear\Domain\Enums;

enum SchoolYearFilterStatus : string
{
    case ALL = "ALL";
    case ACTIVE = "ACTIVE";
    case INACTIVE = "INACTIVE";
}