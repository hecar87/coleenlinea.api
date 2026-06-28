<?php
namespace App\Modules\SchoolClass\Application\DTOs;

use Illuminate\Http\Request;

class CreateSchoolClassDTO
{
    public function __construct(
        public int $Id_SchoolClass,
		public string $SchoolClass_Name,
		public string $SchoolClass_Section,
		public int $SchoolClass_Public,
		public int $SchoolClass_Status,
		public int $Id_School,
		public int $Id_SchoolLevel
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolClass: (int) $oRequest->input("Id_SchoolClass", 0),
            SchoolClass_Name: $oRequest->input("SchoolClass_Name", ""),
            SchoolClass_Section: $oRequest->input("SchoolClass_Section", ""),
            SchoolClass_Public: (int) $oRequest->input("SchoolClass_Public", 0),
            SchoolClass_Status: (int) $oRequest->input("SchoolClass_Status", 0),
            Id_School: (int) $oRequest->input("Id_School", 0),
            Id_SchoolLevel: (int) $oRequest->input("Id_SchoolLevel", 0)
        );
    }
}