<?php
namespace App\Modules\StudentGuardian\Application\DTOs;

use Illuminate\Http\Request;

class CreateStudentGuardianDTO
{
    public function __construct(
        public int $Id_StudentGuardian,
        public string $StudentGuardian_Number,
		public string $StudentGuardian_CCI,
		public string $StudentGuardian_Remark,
		public int $StudentGuardian_Public,
		public int $StudentGuardian_Status,
		public int $Id_School,
		public int $Id_TypeBank,
		public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_StudentGuardian: (int) $oRequest->input('Id_StudentGuardian', 0),
            StudentGuardian_Number: $oRequest->input('StudentGuardian_Number', ''),
            StudentGuardian_CCI: $oRequest->input('StudentGuardian_CCI', ''),
            StudentGuardian_Remark: $oRequest->input('StudentGuardian_Remark', ''),
            StudentGuardian_Public: (int) $oRequest->input('StudentGuardian_Public', 2),
            StudentGuardian_Status: (int) $oRequest->input('StudentGuardian_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}