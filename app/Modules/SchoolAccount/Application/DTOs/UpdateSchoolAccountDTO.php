<?php
namespace App\Modules\SchoolAccount\Application\DTOs;

use Illuminate\Http\Request;

class UpdateSchoolAccountDTO
{
    public function __construct(
        public int $Id_SchoolAccount,
        public string $SchoolAccount_Number,
		public string $SchoolAccount_CCI,
		public string $SchoolAccount_Remark,
		public int $SchoolAccount_Public,
		public int $SchoolAccount_Status,
		public int $Id_School,
		public int $Id_TypeBank,
		public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolAccount: (int) $oRequest->input('Id_SchoolAccount', 0),
            SchoolAccount_Number: $oRequest->input('SchoolAccount_Number', ''),
            SchoolAccount_CCI: $oRequest->input('SchoolAccount_CCI', ''),
            SchoolAccount_Remark: $oRequest->input('SchoolAccount_Remark', ''),
            SchoolAccount_Public: (int) $oRequest->input('SchoolAccount_Public', 2),
            SchoolAccount_Status: (int) $oRequest->input('SchoolAccount_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}