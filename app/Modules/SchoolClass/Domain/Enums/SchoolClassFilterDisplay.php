<?php

namespace App\Modules\SchoolClass\Domain\Enums;

enum SchoolClassFilterDisplay : string
{
    case ALL = "ALL";
    case PUBLIC = "PUBLIC";
    case PRIVATE = "PRIVATE";
}