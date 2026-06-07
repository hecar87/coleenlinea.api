<?php
namespace App\Modules\SchoolBranch\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolBranchDTO
{
    public function __construct(
        public int $Id_SchoolBranch,
        public string $SchoolBranch_Code,
        public string $SchoolBranch_Name,
        public string $SchoolBranch_Address,
        public int $SchoolBranch_Status,
        public int $Id_School
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolBranch: (int) $oRequest->input('Id_SchoolBranch', 0),
            SchoolBranch_Code: $oRequest->input('SchoolBranch_Code', ''),
            SchoolBranch_Name: $oRequest->input('SchoolBranch_Name', ''),
            SchoolBranch_Address: $oRequest->input('SchoolBranch_Address', ''),
            SchoolBranch_Status: (int) $oRequest->input('SchoolBranch_Status', 0),
            Id_School: (int) $oRequest->input('Id_School', 0)
        );
    }
}