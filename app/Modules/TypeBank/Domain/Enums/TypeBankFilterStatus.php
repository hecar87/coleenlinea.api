<?php

namespace App\Modules\TypeBank\Domain\Enums;

enum TypeBankFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}