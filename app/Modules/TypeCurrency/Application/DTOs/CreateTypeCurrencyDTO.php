<?php

namespace App\Modules\TypeCurrency\Application\DTOs;

use Illuminate\Http\Request;

class CreateTypeCurrencyDTO
{
    public function __construct(
        public int $Id_TypeCurrency,
        public string $TypeCurrency_Code,
        public string $TypeCurrency_Name,
        public string $TypeCurrency_Symbol,
        public int $TypeCurrency_Public,
        public int $TypeCurrency_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0),
            TypeCurrency_Code: $oRequest->input('TypeCurrency_Code', ''),
            TypeCurrency_Name: $oRequest->input('TypeCurrency_Name', ''),
            TypeCurrency_Symbol: $oRequest->input('TypeCurrency_Symbol', ''),
            TypeCurrency_Public: (int) $oRequest->input('TypeCurrency_Public', 2),
            TypeCurrency_Status: (int) $oRequest->input('TypeCurrency_Status', 2)
        );
    }
}