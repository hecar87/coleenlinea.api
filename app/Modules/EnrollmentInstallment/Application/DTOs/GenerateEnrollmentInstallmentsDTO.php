<?php
namespace App\Modules\EnrollmentInstallment\Application\DTOs;

use Illuminate\Http\Request;

class GenerateEnrollmentInstallmentsDTO
{
    public function __construct(
		public int $Id_Enrollment,
		public int $Id_TypeCurrency,
		public int $Id_TypeInstallment
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Enrollment: (int) $oRequest->input("Id_Enrollment", 0),
            Id_TypeCurrency: (int) $oRequest->input("Id_TypeCurrency", 0),
            Id_TypeInstallment: (int) $oRequest->input("Id_TypeInstallment", 0)
        );
    }
}