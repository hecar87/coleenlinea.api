<?php

namespace App\Modules\TypeCurrency\Domain\Enums;

enum TypeCurrencyFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}