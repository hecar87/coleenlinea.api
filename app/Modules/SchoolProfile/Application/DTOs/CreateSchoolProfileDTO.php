<?php
namespace App\Modules\SchoolProfile\Application\DTOs;

use Illuminate\Http\Request;

class CreateSchoolProfileDTO
{
    public function __construct(
        public int $Id_SchoolProfile,
		public string $SchoolProfile_Name,
		public string $SchoolProfile_Description,
		public int $SchoolProfile_Newed,
		public int $SchoolProfile_Type,
		public int $SchoolProfile_Status,
		public int $Id_School,
		public int $Id_SchoolYear,
		public int $Id_SchoolLevel
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolProfile: (int) $oRequest->input('Id_SchoolProfile', 0),
            SchoolProfile_Name: $oRequest->input('SchoolProfile_Name', ''),
            SchoolProfile_Description: $oRequest->input('SchoolProfile_Description', ''),
            SchoolProfile_Newed: (int) $oRequest->input('SchoolProfile_Newed', 0),
            SchoolProfile_Type: (int) $oRequest->input('SchoolProfile_Type', 0),
            SchoolProfile_Status: (int) $oRequest->input('SchoolProfile_Status', 0),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_SchoolYear: (int) $oRequest->input('Id_SchoolYear', 0),
            Id_SchoolLevel: (int) $oRequest->input('Id_SchoolLevel', 0)
        );
    }
}