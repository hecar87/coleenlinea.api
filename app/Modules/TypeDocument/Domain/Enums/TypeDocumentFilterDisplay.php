<?php

namespace App\Modules\TypeDocument\Domain\Enums;

enum TypeDocumentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}