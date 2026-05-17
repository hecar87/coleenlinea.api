<?php

namespace App\Modules\TypeReceipt\Domain\Enums;

enum TypeReceiptStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}