<?php
namespace App\Modules\SchoolLevel\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolLevelDTO
{
    public function __construct(
        public int $Id_SchoolLevel,
		public string $SchoolLevel_Code,
		public int $Id_School,
		public int $Id_TypeLevel
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolLevel: (int) $oRequest->input("Id_SchoolLevel", 0),
            SchoolLevel_Code: $oRequest->input("SchoolLevel_Code", 0),
            Id_School: (int) $oRequest->input("Id_School", 0),
            Id_TypeLevel: (int) $oRequest->input("Id_TypeLevel", 0)
        );
    }
}