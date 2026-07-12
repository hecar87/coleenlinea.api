<?php
namespace App\Modules\EnrollmentInstallment\Application\DTOs;

use Illuminate\Http\Request;

class UpdateEnrollmentInstallmentDTO
{
    public function __construct(
        public int $Id_EnrollmentInstallment,
        public int $EnrollmentInstallment_Order,
		public string $EnrollmentInstallment_Description,
		public float $EnrollmentInstallment_Amount_Budgeted,
		public float $EnrollmentInstallment_Amount_Discounted,
		public float $EnrollmentInstallment_Amount_Payabled,
		public string $EnrollmentInstallment_Date_Collection,
		public string $EnrollmentInstallment_Date_Due,
		public int $EnrollmentInstallment_Required,
		public int $Id_Enrollment,
		public int $Id_TypeCurrency,
		public int $Id_TypeInstallment
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_EnrollmentInstallment: (int) $oRequest->input("Id_EnrollmentInstallment", 0),
            EnrollmentInstallment_Order: (int) $oRequest->input("EnrollmentInstallment_Order", 0),
            EnrollmentInstallment_Description: $oRequest->input("EnrollmentInstallment_Description", 0),
            EnrollmentInstallment_Amount_Budgeted: (float) $oRequest->input("EnrollmentInstallment_Amount_Budgeted", 0),
            EnrollmentInstallment_Amount_Discounted: (float) $oRequest->input("EnrollmentInstallment_Amount_Discounted", 0),
            EnrollmentInstallment_Amount_Payabled: (float) $oRequest->input("EnrollmentInstallment_Amount_Payabled", 0),
            EnrollmentInstallment_Date_Collection: $oRequest->input("EnrollmentInstallment_Date_Collection", 0),
            EnrollmentInstallment_Date_Due: $oRequest->input("EnrollmentInstallment_Date_Due", 0),
            EnrollmentInstallment_Required: (int) $oRequest->input("EnrollmentInstallment_Required", 0),
            Id_Enrollment: (int) $oRequest->input("Id_Enrollment", 0),
            Id_TypeCurrency: (int) $oRequest->input("Id_TypeCurrency", 0),
            Id_TypeInstallment: (int) $oRequest->input("Id_TypeInstallment", 0)
        );
    }
}