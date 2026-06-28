<?php

namespace App\Modules\SchoolLevel\Domain\Enums;

enum SchoolLevelFilterDisplay : string
{
    case ALL = "ALL";
    case PUBLIC = "PUBLIC";
    case PRIVATE = "PRIVATE";
}