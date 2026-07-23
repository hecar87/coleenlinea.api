<?php
namespace App\Modules\SchoolInstallment\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolInstallmentDTO
{
    public function __construct(
        public int $Id_SchoolInstallment,
		public int $Id_SchoolProfile,
		public int $Id_TypeCurrency,
		public int $Id_TypeInstallment
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolInstallment: (int) $oRequest->input("Id_SchoolInstallment", 0),
            Id_SchoolProfile: (int) $oRequest->input("Id_SchoolProfile", 0),
            Id_TypeCurrency: (int) $oRequest->input("Id_TypeCurrency", 0),
            Id_TypeInstallment: (int) $oRequest->input("Id_TypeInstallment", 0)
        );
    }
}