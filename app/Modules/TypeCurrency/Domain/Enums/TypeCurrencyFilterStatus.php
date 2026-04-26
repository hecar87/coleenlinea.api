<?php

namespace App\Domain\TypeCurrency\Enums;

enum TypeCurrencyFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}