<?php

namespace App\Domain\TypeDocument\Enums;

enum TypeDocumentFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}