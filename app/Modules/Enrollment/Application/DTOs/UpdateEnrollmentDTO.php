<?php
namespace App\Modules\Enrollment\Application\DTOs;

use Illuminate\Http\Request;

class UpdateEnrollmentDTO
{
    public function __construct(
        public int $Id_Enrollment,
        public string $Enrollment_Number,
		public string $Enrollment_CCI,
		public string $Enrollment_Remark,
		public int $Enrollment_Public,
		public int $Enrollment_Status,
		public int $Id_School,
		public int $Id_TypeBank,
		public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Enrollment: (int) $oRequest->input('Id_Enrollment', 0),
            Enrollment_Number: $oRequest->input('Enrollment_Number', ''),
            Enrollment_CCI: $oRequest->input('Enrollment_CCI', ''),
            Enrollment_Remark: $oRequest->input('Enrollment_Remark', ''),
            Enrollment_Public: (int) $oRequest->input('Enrollment_Public', 2),
            Enrollment_Status: (int) $oRequest->input('Enrollment_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}