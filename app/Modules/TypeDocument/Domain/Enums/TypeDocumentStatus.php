<?php

namespace App\Modules\TypeDocument\Domain\Enums;

enum TypeDocumentStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}