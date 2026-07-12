<?php
namespace App\Modules\EnrollmentInstallment\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedEnrollmentInstallmentDTO
{
    public function __construct(
        public int $Id_EnrollmentInstallment,
        public int $EnrollmentInstallment_Order,
		public int $Id_Enrollment,
		public int $Id_TypeCurrency,
		public int $Id_TypeInstallment
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_EnrollmentInstallment: (int) $oRequest->input("Id_EnrollmentInstallment", 0),
            EnrollmentInstallment_Order: (int) $oRequest->input("EnrollmentInstallment_Order", 0),
            Id_Enrollment: (int) $oRequest->input("Id_Enrollment", 0),
            Id_TypeCurrency: (int) $oRequest->input("Id_TypeCurrency", 0),
            Id_TypeInstallment: (int) $oRequest->input("Id_TypeInstallment", 0)
        );
    }
}