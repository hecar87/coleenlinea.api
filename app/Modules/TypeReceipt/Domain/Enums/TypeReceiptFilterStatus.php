<?php

namespace App\Modules\TypeReceipt\Domain\Enums;

enum TypeReceiptFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}