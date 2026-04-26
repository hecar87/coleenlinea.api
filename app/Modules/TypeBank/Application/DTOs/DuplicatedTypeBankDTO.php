<?php
namespace App\Application\TypeBank\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeBankDTO
{
    public function __construct(
        public int $Id_TypeBank,
        public string $TypeBank_Code,
        public string $TypeBank_Name,
        public string $TypeBank_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            TypeBank_Code: $oRequest->input('TypeBank_Code', ''),
            TypeBank_Name: $oRequest->input('TypeBank_Name', ''),
            TypeBank_Abrv: $oRequest->input('TypeBank_Abrv', '')
        );
    }
}