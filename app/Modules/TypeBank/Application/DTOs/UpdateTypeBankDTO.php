<?php

namespace App\Modules\TypeBank\Application\DTOs;

use Illuminate\Http\Request;

class UpdateTypeBankDTO
{
    public function __construct(
        public int $Id_TypeBank,
        public string $TypeBank_Code,
        public string $TypeBank_Name,
        public string $TypeBank_Abrv,
        public int $TypeBank_Public,
        public int $TypeBank_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank'),
            TypeBank_Code: $oRequest->input('TypeBank_Code', ''),
            TypeBank_Name: $oRequest->input('TypeBank_Name', ''),
            TypeBank_Abrv: $oRequest->input('TypeBank_Abrv', ''),
            TypeBank_Public: (int) $oRequest->input('TypeBank_Public', 2),
            TypeBank_Status: (int) $oRequest->input('TypeBank_Status', 2)
        );
    }
}