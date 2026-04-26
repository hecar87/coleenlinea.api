<?php

namespace App\Modules\City\Domain\Enums;

enum CityFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}