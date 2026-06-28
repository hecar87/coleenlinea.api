<?php

namespace App\Modules\Contract\Domain\Enums;

enum ContractFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}