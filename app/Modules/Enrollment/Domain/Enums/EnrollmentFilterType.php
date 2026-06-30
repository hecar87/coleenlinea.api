<?php

namespace App\Modules\Enrollment\Domain\Enums;

enum EnrollmentFilterType : string
{
    case ALL = 'ALL';
    case REPEATER = 'REPEATER';
    case PROMOTED = 'PROMOTED';
}