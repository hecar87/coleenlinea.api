<?php

namespace App\Modules\Enrollment\Domain\Enums;

enum EnrollmentFilterNewed : string
{
    case ALL = 'ALL';
    case REGULAR = 'REGULAR';
    case NEWED = 'NEWED';
}