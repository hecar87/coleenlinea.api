<?php

namespace App\Modules\Student\Domain\Enums;

enum StudentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}