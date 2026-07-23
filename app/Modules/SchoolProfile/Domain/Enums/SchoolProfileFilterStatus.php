<?php

namespace App\Modules\SchoolProfile\Domain\Enums;

enum SchoolProfileFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}