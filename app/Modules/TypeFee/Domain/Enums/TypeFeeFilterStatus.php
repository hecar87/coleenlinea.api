<?php

namespace App\Modules\TypeFee\Domain\Enums;

enum TypeFeeFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}