<?php

namespace App\Modules\TypeDocument\Domain\Enums;

enum TypeDocumentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}