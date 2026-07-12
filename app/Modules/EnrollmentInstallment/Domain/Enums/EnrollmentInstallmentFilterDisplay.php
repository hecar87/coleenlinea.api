<?php

namespace App\Modules\SchoolAccount\Domain\Enums;

enum SchoolAccountFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}