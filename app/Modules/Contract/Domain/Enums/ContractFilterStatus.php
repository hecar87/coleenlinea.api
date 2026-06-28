<?php

namespace App\Modules\Contract\Domain\Enums;

enum ContractFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}