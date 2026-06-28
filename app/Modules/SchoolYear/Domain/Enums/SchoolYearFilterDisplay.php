<?php

namespace App\Modules\SchoolYear\Domain\Enums;

enum SchoolYearFilterDisplay : string
{
    case ALL = "ALL";
    case PUBLIC = "PUBLIC";
    case PRIVATE = "PRIVATE";
}