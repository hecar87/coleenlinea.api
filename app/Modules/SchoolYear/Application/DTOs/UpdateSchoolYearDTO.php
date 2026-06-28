<?php
namespace App\Modules\SchoolYear\Application\DTOs;

use Illuminate\Http\Request;

class UpdateSchoolYearDTO
{
    public function __construct(
        public int $Id_SchoolYear,
        public string $SchoolYear_Name,
		public int $SchoolYear_Year,
		public string $SchoolYear_Date_Start,
		public string $SchoolYear_Date_End,
		public int $SchoolYear_Status,
		public int $Id_School
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolYear: (int) $oRequest->input("Id_SchoolYear", 0),
            SchoolYear_Name: $oRequest->input("SchoolYear_Name", ""),
            SchoolYear_Year: (int) $oRequest->input("SchoolYear_Year", 0),
            SchoolYear_Date_Start: $oRequest->input("SchoolYear_Date_Start", ""),
            SchoolYear_Date_End: $oRequest->input("SchoolYear_Date_End", ""),
            SchoolYear_Status: (int) $oRequest->input("SchoolYear_Status", 0),
            Id_School: (int) $oRequest->input("Id_School", 0)
        );
    }
}