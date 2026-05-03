<?php

namespace App\Modules\TypeInstallment\Domain\Enums;

enum TypeInstallmentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}