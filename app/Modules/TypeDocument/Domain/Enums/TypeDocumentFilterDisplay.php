<?php

namespace App\Domain\TypeDocument\Enums;

enum TypeDocumentFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}