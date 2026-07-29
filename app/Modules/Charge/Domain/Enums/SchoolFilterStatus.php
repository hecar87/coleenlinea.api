<?php

namespace App\Modules\School\Domain\Enums;

enum SchoolFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}