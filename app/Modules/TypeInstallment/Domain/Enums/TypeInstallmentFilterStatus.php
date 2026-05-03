<?php

namespace App\Modules\TypeInstallment\Domain\Enums;

enum TypeInstallmentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}