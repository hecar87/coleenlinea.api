<?php
namespace App\Modules\SchoolBranch\Application\DTOs;

use Illuminate\Http\Request;

class UpdateSchoolBranchDTO
{
    public function __construct(
        public int $Id_SchoolBranch,
        public string $SchoolBranch_Number,
		public string $SchoolBranch_CCI,
		public string $SchoolBranch_Remark,
		public int $SchoolBranch_Public,
		public int $SchoolBranch_Status,
		public int $Id_School,
		public int $Id_TypeBank,
		public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolBranch: (int) $oRequest->input('Id_SchoolBranch', 0),
            SchoolBranch_Number: $oRequest->input('SchoolBranch_Number', ''),
            SchoolBranch_CCI: $oRequest->input('SchoolBranch_CCI', ''),
            SchoolBranch_Remark: $oRequest->input('SchoolBranch_Remark', ''),
            SchoolBranch_Public: (int) $oRequest->input('SchoolBranch_Public', 2),
            SchoolBranch_Status: (int) $oRequest->input('SchoolBranch_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}