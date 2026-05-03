<?php

namespace App\Modules\TypeDocument\Application\DTOs;

use Illuminate\Http\Request;

class CreateTypeDocumentDTO
{
    public function __construct(
        public int $Id_TypeDocument,
        public string $TypeDocument_Name,
        public string $TypeDocument_Abrv,
        public int $TypeDocument_Public,
        public int $TypeDocument_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0),
            TypeDocument_Name: $oRequest->input('TypeDocument_Name', ''),
            TypeDocument_Abrv: $oRequest->input('TypeDocument_Abrv', ''),
            TypeDocument_Public: (int) $oRequest->input('TypeDocument_Public', 2),
            TypeDocument_Status: (int) $oRequest->input('TypeDocument_Status', 2)
        );
    }
}