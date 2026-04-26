<?php

namespace App\Domain\TypeInstallment\Enums;

enum TypeInstallmentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}