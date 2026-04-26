<?php

namespace App\Domain\TypeCurrency\Enums;

enum TypeCurrencyFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}