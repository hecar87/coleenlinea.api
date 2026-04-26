<?php

namespace App\Domain\TypePayment\Enums;

enum TypePaymentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}