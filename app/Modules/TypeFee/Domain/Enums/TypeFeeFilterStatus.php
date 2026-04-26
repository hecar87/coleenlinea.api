<?php

namespace App\Domain\TypeFee\Enums;

enum TypeFeeFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}