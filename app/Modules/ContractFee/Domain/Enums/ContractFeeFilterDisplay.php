<?php

namespace App\Modules\ContractFee\Domain\Enums;

enum ContractFeeFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}