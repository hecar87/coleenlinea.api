<?php

namespace App\Modules\SchoolInstallment\Domain\Enums;

enum SchoolInstallmentFilterDisplay : string
{
    case ALL = "ALL";
    case PUBLIC = "PUBLIC";
    case PRIVATE = "PRIVATE";
}