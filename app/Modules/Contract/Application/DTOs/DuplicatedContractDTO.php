<?php
namespace App\Modules\Contract\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedContractDTO
{
    public function __construct(
        public int $Id_Contract,
        public string $Contract_Number,
        public string $Contract_CCI,
        public int $Id_School,
        public int $Id_TypeBank,
        public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Contract: (int) $oRequest->input('Id_Contract', 0),
            Contract_Number: $oRequest->input('Contract_Number', ''),
            Contract_CCI: $oRequest->input('Contract_CCI', ''),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}