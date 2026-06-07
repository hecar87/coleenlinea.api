<?php
namespace App\Modules\SchoolBranch\Application\DTOs;

use Illuminate\Http\Request;

class UpdateSchoolBranchDTO
{
    public function __construct(
        public int $Id_SchoolBranch,
        public string $SchoolBranch_Code,
		public string $SchoolBranch_Name,
		public string $SchoolBranch_Address,
		public string $SchoolBranch_Phone,
		public float $SchoolBranch_LAT,
		public float $SchoolBranch_LNG,
		public int $SchoolBranch_Public,
		public int $SchoolBranch_Status,
		public int $Id_School,
		public int $Id_State,
		public int $Id_City,
		public int $Id_District
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolBranch: (int) $oRequest->input('Id_SchoolBranch', 0),
            SchoolBranch_Code: $oRequest->input('SchoolBranch_Code', ''),
            SchoolBranch_Name: $oRequest->input('SchoolBranch_Name', ''),
            SchoolBranch_Address: $oRequest->input('SchoolBranch_Address', ''),
            SchoolBranch_Phone: $oRequest->input('SchoolBranch_Phone', ''),
            SchoolBranch_LAT: (float) $oRequest->input('SchoolBranch_LAT', 0),
            SchoolBranch_LNG: (float) $oRequest->input('SchoolBranch_LNG', 0),
            SchoolBranch_Public: (int) $oRequest->input('SchoolBranch_Public', 2),
            SchoolBranch_Status: (int) $oRequest->input('SchoolBranch_Status', 2),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_State: (int) $oRequest->input('Id_State', 0),
            Id_City: (int) $oRequest->input('Id_City', 0),
            Id_District: (int) $oRequest->input('Id_District', 0)
        );
    }
}