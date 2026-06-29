<?php

namespace App\Modules\Enrollment\Domain\Enums;

enum EnrollmentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}