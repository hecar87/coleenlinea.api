<?php

namespace App\Modules\ContractFee\Domain\Enums;

enum ContractFeeFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}