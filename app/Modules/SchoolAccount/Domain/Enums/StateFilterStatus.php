<?php

namespace App\Modules\State\Domain\Enums;

enum StateFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}