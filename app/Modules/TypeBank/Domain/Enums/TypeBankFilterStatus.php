<?php

namespace App\Domain\TypeBank\Enums;

enum TypeBankFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}