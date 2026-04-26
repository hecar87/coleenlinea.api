<?php

namespace App\Domain\TypeReceipt\Enums;

enum TypeReceiptFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}