<?php

namespace App\Modules\TypeCurrency\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeCurrencyDTO
{
    public function __construct(
        public int $Id_TypeCurrency,
        public string $TypeCurrency_Code,
        public string $TypeCurrency_Name,
        public string $TypeCurrency_Symbol
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0),
            TypeCurrency_Code: $oRequest->input('TypeCurrency_Code', ''),
            TypeCurrency_Name: $oRequest->input('TypeCurrency_Name', ''),
            TypeCurrency_Symbol: $oRequest->input('TypeCurrency_Symbol', '')
        );
    }
}