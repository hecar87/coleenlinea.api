<?php

namespace App\Modules\EnrollmentInstallment\Domain\Enums;

enum EnrollmentInstallmentFilterRequired : string
{
    case ALL = 'ALL';
    case OPTIONAL = 'OPTIONAL';
    case REQUIRED = 'REQUIRED';
}