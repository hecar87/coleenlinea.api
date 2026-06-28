<?php
namespace App\Modules\SchoolYear\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolYearDTO
{
    public function __construct(
        public int $Id_SchoolYear,
        public string $SchoolYear_Name,
		public int $SchoolYear_Year,
		public int $Id_School
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolYear: (int) $oRequest->input("Id_SchoolYear", 0),
            SchoolYear_Name: $oRequest->input("SchoolYear_Name", ""),
            SchoolYear_Year: (int) $oRequest->input("SchoolYear_Year", 0),
            Id_School: (int) $oRequest->input("Id_School", 0)
        );
    }
}