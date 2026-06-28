<?php
namespace App\Modules\ContractFee\Application\DTOs;

use Illuminate\Http\Request;

class UpdateContractFeeDTO
{
    public function __construct(
        public int $Id_ContractFee,
        public string $ContractFee_Number,
		public string $ContractFee_CCI,
		public string $ContractFee_Remark,
		public int $ContractFee_Public,
		public int $ContractFee_Status,
		public int $Id_School,
		public int $Id_TypeBank,
		public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_ContractFee: (int) $oRequest->input('Id_ContractFee', 0),
            ContractFee_Number: $oRequest->input('ContractFee_Number', ''),
            ContractFee_CCI: $oRequest->input('ContractFee_CCI', ''),
            ContractFee_Remark: $oRequest->input('ContractFee_Remark', ''),
            ContractFee_Public: (int) $oRequest->input('ContractFee_Public', 2),
            ContractFee_Status: (int) $oRequest->input('ContractFee_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}