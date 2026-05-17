<?php

namespace App\Modules\TypeReceipt\Domain\Enums;

enum TypeReceiptFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}