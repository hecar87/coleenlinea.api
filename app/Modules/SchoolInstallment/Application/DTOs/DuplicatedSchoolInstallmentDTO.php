<?php
namespace App\Modules\SchoolInstallment\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolInstallmentDTO
{
    public function __construct(
        public int $Id_SchoolInstallment,
		public int $Id_SchoolYear,
		public int $Id_SchoolLevel,
		public int $Id_TypeInstallment
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolInstallment: (int) $oRequest->input("Id_SchoolInstallment", 0),
            Id_SchoolYear: (int) $oRequest->input("Id_SchoolYear", 0),
            Id_SchoolLevel: (int) $oRequest->input("Id_SchoolLevel", 0),
            Id_TypeInstallment: (int) $oRequest->input("Id_TypeInstallment", 0)
        );
    }
}