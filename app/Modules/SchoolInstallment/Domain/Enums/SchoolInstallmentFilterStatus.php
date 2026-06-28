<?php

namespace App\Modules\SchoolInstallment\Domain\Enums;

enum SchoolInstallmentFilterStatus : string
{
    case ALL = "ALL";
    case ACTIVE = "ACTIVE";
    case INACTIVE = "INACTIVE";
}