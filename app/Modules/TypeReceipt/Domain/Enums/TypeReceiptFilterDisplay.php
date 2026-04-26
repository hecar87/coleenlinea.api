<?php

namespace App\Domain\TypeReceipt\Enums;

enum TypeReceiptFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}