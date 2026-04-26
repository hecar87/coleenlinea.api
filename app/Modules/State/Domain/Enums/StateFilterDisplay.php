<?php

namespace App\Modules\State\Domain\Enums;

enum StateFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}