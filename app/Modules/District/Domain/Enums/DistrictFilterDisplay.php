<?php

namespace App\Modules\District\Domain\Enums;

enum DistrictFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}