<?php

namespace App\Modules\EnrollmentInstallment\Domain\Enums;

enum EnrollmentInstallmentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}