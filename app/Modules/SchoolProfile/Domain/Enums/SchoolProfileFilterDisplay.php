<?php

namespace App\Modules\SchoolProfile\Domain\Enums;

enum SchoolProfileFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}