<?php

namespace App\Modules\Enrollment\Domain\Enums;

enum EnrollmentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}