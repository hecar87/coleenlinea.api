<?php

namespace App\Domain\TypeBank\Enums;

enum TypeBankFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}