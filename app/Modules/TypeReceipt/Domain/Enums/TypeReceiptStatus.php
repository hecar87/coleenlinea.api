<?php

namespace App\Domain\TypeReceipt\Enums;

enum TypeReceiptStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}