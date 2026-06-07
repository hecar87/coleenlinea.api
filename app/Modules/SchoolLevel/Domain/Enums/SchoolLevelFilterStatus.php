<?php

namespace App\Modules\SchoolAccount\Domain\Enums;

enum SchoolAccountFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}