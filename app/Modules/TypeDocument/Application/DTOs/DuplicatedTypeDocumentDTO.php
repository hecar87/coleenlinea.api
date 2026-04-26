<?php
namespace App\Application\TypeDocument\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeDocumentDTO
{
    public function __construct(
        public int $Id_TypeDocument,
        public string $TypeDocument_Name,
        public string $TypeDocument_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0),
            TypeDocument_Name: $oRequest->input('TypeDocument_Name', ''),
            TypeDocument_Abrv: $oRequest->input('TypeDocument_Abrv', '')
        );
    }
}