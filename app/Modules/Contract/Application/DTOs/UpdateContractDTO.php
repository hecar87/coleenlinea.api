<?php
namespace App\Modules\Contract\Application\DTOs;

use Illuminate\Http\Request;

class UpdateContractDTO
{
    public function __construct(
        public int $Id_Contract,
        public string $Contract_Number,
		public string $Contract_CCI,
		public string $Contract_Remark,
		public int $Contract_Public,
		public int $Contract_Status,
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
            Contract_Remark: $oRequest->input('Contract_Remark', ''),
            Contract_Public: (int) $oRequest->input('Contract_Public', 2),
            Contract_Status: (int) $oRequest->input('Contract_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}