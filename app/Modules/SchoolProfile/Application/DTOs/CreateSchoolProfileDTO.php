<?php
namespace App\Modules\SchoolProfile\Application\DTOs;

use Illuminate\Http\Request;

class CreateSchoolProfileDTO
{
    public function __construct(
        public int $Id_SchoolProfile,
        public string $SchoolProfile_Number,
		public string $SchoolProfile_CCI,
		public string $SchoolProfile_Remark,
		public int $SchoolProfile_Public,
		public int $SchoolProfile_Status,
		public int $Id_School,
		public int $Id_TypeBank,
		public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolProfile: (int) $oRequest->input('Id_SchoolProfile', 0),
            SchoolProfile_Number: $oRequest->input('SchoolProfile_Number', ''),
            SchoolProfile_CCI: $oRequest->input('SchoolProfile_CCI', ''),
            SchoolProfile_Remark: $oRequest->input('SchoolProfile_Remark', ''),
            SchoolProfile_Public: (int) $oRequest->input('SchoolProfile_Public', 2),
            SchoolProfile_Status: (int) $oRequest->input('SchoolProfile_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}