<?php

namespace App\Domain\TypeFee\Enums;

enum TypeFeeFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}