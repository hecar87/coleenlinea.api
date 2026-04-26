<?php

namespace App\Modules\TypeBank\Domain\Enums;

enum TypeBankFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}