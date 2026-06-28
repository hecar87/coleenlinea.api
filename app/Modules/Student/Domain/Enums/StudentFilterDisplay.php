<?php

namespace App\Modules\Student\Domain\Enums;

enum StudentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}