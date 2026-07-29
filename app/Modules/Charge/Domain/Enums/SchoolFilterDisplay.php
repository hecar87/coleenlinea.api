<?php

namespace App\Modules\School\Domain\Enums;

enum SchoolFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}