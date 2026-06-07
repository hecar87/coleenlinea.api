<?php
namespace App\Modules\SchoolLevel\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolLevelDTO
{
    public function __construct(
        public int $Id_SchoolLevel,
        public string $SchoolLevel_Number,
        public string $SchoolLevel_CCI,
        public int $Id_School,
        public int $Id_TypeBank,
        public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolLevel: (int) $oRequest->input('Id_SchoolLevel', 0),
            SchoolLevel_Number: $oRequest->input('SchoolLevel_Number', ''),
            SchoolLevel_CCI: $oRequest->input('SchoolLevel_CCI', ''),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}