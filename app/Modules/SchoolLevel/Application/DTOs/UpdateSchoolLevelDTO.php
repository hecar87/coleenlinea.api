<?php
namespace App\Modules\SchoolLevel\Application\DTOs;

use Illuminate\Http\Request;

class UpdateSchoolLevelDTO
{
    public function __construct(
        public int $Id_SchoolLevel,
		public string $SchoolLevel_Code,
		public string $SchoolLevel_Shift,
		public int $SchoolLevel_Public,
		public int $SchoolLevel_Status,
		public int $Id_School,
		public int $Id_TypeLevel
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolLevel: (int) $oRequest->input("Id_SchoolLevel", 0),
            SchoolLevel_Code: $oRequest->input("SchoolLevel_Code", 0),
            SchoolLevel_Shift: $oRequest->input("SchoolLevel_Shift", 0),
            SchoolLevel_Public: (int) $oRequest->input("SchoolLevel_Public", 0),
            SchoolLevel_Status: (int) $oRequest->input("SchoolLevel_Status", 0),
            Id_School: (int) $oRequest->input("Id_School", 0),
            Id_TypeLevel: (int) $oRequest->input("Id_TypeLevel", 0)
        );
    }
}