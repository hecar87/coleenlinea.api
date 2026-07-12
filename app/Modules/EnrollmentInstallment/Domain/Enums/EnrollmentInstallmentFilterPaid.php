<?php

namespace App\Modules\EnrollmentInstallment\Domain\Enums;

enum EnrollmentInstallmentFilterPaid : string
{
    case ALL = 'ALL';
    case PAID = 'PAID';
    case PENDING = 'PENDING';
}