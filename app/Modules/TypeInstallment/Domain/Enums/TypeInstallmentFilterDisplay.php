<?php

namespace App\Domain\TypeInstallment\Enums;

enum TypeInstallmentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}