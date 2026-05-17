<?php

namespace App\Modules\TypePayment\Domain\Enums;

enum TypePaymentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}