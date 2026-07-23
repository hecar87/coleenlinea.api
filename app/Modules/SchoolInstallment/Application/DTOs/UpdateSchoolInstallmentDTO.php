<?php
namespace App\Modules\SchoolInstallment\Application\DTOs;

use Illuminate\Http\Request;

class UpdateSchoolInstallmentDTO
{
    public function __construct(
        public int $Id_SchoolInstallment,
		public float $SchoolInstallment_Amount,
		public string $SchoolInstallment_Date_Start,
		public string $SchoolInstallment_Date_End,
		public int $SchoolInstallment_Required,
        public int $SchoolInstallment_Status,
		public int $Id_SchoolProfile,
		public int $Id_TypeCurrency,
		public int $Id_TypeInstallment
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolInstallment: (int) $oRequest->input("Id_SchoolInstallment", 0),
            SchoolInstallment_Amount: (float) $oRequest->input("SchoolInstallment_Amount", 0),
            SchoolInstallment_Date_Start: $oRequest->input("SchoolInstallment_Date_Start", ""),
            SchoolInstallment_Date_End: $oRequest->input("SchoolInstallment_Date_End", ""),
            SchoolInstallment_Required: (int) $oRequest->input("SchoolInstallment_Required", 0),
            SchoolInstallment_Status: (int) $oRequest->input("SchoolInstallment_Status", 0),
            Id_SchoolProfile: (int) $oRequest->input("Id_SchoolProfile", 0),
            Id_TypeCurrency: (int) $oRequest->input("Id_TypeCurrency", 0),
            Id_TypeInstallment: (int) $oRequest->input("Id_TypeInstallment", 0)
        );
    }
}