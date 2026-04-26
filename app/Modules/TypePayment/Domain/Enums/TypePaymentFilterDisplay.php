<?php

namespace App\Domain\TypePayment\Enums;

enum TypePaymentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}