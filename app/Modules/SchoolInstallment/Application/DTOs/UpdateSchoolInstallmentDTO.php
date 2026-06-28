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
		public int $SchoolInstallment_Promoted,
		public int $SchoolInstallment_Repeated,
		public int $SchoolInstallment_Newed,
		public int $SchoolInstallment_Status,
		public int $Id_SchoolYear,
		public int $Id_SchoolLevel,
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
            SchoolInstallment_Promoted: (int) $oRequest->input("SchoolInstallment_Promoted", 0),
            SchoolInstallment_Repeated: (int) $oRequest->input("SchoolInstallment_Repeated", 0),
            SchoolInstallment_Newed: (int) $oRequest->input("SchoolInstallment_Newed", 0),
            SchoolInstallment_Status: (int) $oRequest->input("SchoolInstallment_Status", 0),
            Id_SchoolYear: (int) $oRequest->input("Id_SchoolYear", 0),
            Id_SchoolLevel: (int) $oRequest->input("Id_SchoolLevel", 0),
            Id_TypeCurrency: (int) $oRequest->input("Id_TypeCurrency", 0),
            Id_TypeInstallment: (int) $oRequest->input("Id_TypeInstallment", 0)
        );
    }
}