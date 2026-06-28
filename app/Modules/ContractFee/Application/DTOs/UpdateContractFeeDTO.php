<?php
namespace App\Modules\ContractFee\Application\DTOs;

use Illuminate\Http\Request;

class UpdateContractFeeDTO
{
    public function __construct(
        public int $Id_ContractFee,
        public float $ContractFee_Fee_Amount,
		public float $ContractFee_Fee_Percentage,
		public int $ContractFee_Fee_Payer,
		public string $ContractFee_Remark,
		public int $Id_Contract,
		public int $Id_TypeCurrency,
		public int $Id_TypeFee
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_ContractFee: (int) $oRequest->input('Id_ContractFee', 0),
            ContractFee_Fee_Amount: (float) $oRequest->input('ContractFee_Fee_Amount', 0),
            ContractFee_Fee_Percentage: (float) $oRequest->input('ContractFee_Fee_Percentage', 0),
            ContractFee_Fee_Payer: (int) $oRequest->input('ContractFee_Fee_Payer', 0),
            ContractFee_Remark: (string) $oRequest->input('ContractFee_Remark', ''),
            Id_Contract: (int) $oRequest->input('Id_Contract', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0),
            Id_TypeFee: (int) $oRequest->input('Id_TypeFee', 0)
        );
    }
}