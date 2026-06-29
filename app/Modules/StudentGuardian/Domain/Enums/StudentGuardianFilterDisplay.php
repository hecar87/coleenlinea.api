<?php

namespace App\Modules\StudentGuardian\Domain\Enums;

enum StudentGuardianFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}