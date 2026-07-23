<?php
namespace App\Modules\SchoolProfile\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolProfileDTO
{
    public function __construct(
        public int $Id_SchoolProfile,
		public string $SchoolProfile_Name,
		public int $Id_School,
		public int $Id_SchoolYear,
		public int $Id_SchoolLevel
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolProfile: (int) $oRequest->input('Id_SchoolProfile', 0),
            SchoolProfile_Name: $oRequest->input('SchoolProfile_Name', ''),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_SchoolYear: (int) $oRequest->input('Id_SchoolYear', 0),
            Id_SchoolLevel: (int) $oRequest->input('Id_SchoolLevel', 0)
        );
    }
}