<?php

namespace App\Modules\Guardian\Domain\Enums;

enum GuardianFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}