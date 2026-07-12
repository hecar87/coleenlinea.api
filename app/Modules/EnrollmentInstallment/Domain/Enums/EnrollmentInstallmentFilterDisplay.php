<?php

namespace App\Modules\EnrollmentInstallment\Domain\Enums;

enum EnrollmentInstallmentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}