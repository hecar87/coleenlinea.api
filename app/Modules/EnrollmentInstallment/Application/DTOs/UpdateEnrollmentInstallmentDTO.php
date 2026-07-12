<?php
namespace App\Modules\EnrollmentInstallment\Application\DTOs;

use Illuminate\Http\Request;

class UpdateEnrollmentInstallmentDTO
{
    public function __construct(
        public int $Id_EnrollmentInstallment,
        public string $EnrollmentInstallment_Number,
		public string $EnrollmentInstallment_CCI,
		public string $EnrollmentInstallment_Remark,
		public int $EnrollmentInstallment_Public,
		public int $EnrollmentInstallment_Status,
		public int $Id_School,
		public int $Id_TypeBank,
		public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_EnrollmentInstallment: (int) $oRequest->input('Id_EnrollmentInstallment', 0),
            EnrollmentInstallment_Number: $oRequest->input('EnrollmentInstallment_Number', ''),
            EnrollmentInstallment_CCI: $oRequest->input('EnrollmentInstallment_CCI', ''),
            EnrollmentInstallment_Remark: $oRequest->input('EnrollmentInstallment_Remark', ''),
            EnrollmentInstallment_Public: (int) $oRequest->input('EnrollmentInstallment_Public', 2),
            EnrollmentInstallment_Status: (int) $oRequest->input('EnrollmentInstallment_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}