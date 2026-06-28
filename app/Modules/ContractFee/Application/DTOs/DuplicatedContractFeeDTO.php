<?php
namespace App\Modules\ContractFee\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedContractFeeDTO
{
    public function __construct(
        public int $Id_ContractFee,
		public int $Id_Contract,
		public int $Id_TypeCurrency,
		public int $Id_TypeFee
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_ContractFee: (int) $oRequest->input('Id_ContractFee', 0),
            Id_Contract: (int) $oRequest->input('Id_Contract', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0),
            Id_TypeFee: (int) $oRequest->input('Id_TypeFee', 0)
        );
    }
}