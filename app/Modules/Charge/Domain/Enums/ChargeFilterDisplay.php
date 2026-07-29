<?php

namespace App\Modules\Charge\Domain\Enums;

enum ChargeFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}