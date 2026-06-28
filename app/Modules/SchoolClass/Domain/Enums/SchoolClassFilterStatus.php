<?php

namespace App\Modules\SchoolClass\Domain\Enums;

enum SchoolClassFilterStatus : string
{
    case ALL = "ALL";
    case ACTIVE = "ACTIVE";
    case INACTIVE = "INACTIVE";
}