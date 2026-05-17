<?php

namespace App\Modules\TypePayment\Domain\Enums;

enum TypePaymentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}