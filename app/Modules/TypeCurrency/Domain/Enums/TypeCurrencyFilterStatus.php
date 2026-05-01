<?php

namespace App\Modules\TypeCurrency\Domain\Enums;

enum TypeCurrencyFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}