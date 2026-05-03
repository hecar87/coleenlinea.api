<?php

namespace App\Modules\TypeFee\Domain\Enums;

enum TypeFeeFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}