<?php
namespace App\Modules\School\Application\DTOs;

use Illuminate\Http\Request;

class UpdateSchoolDTO
{
    public function __construct(
        public int $Id_School,
        public string $School_Code,
        public string $School_Name,
        public string $School_Abrv,
        public int $School_Public,
        public int $School_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_School: (int) $oRequest->input('Id_School'),
            School_Code: $oRequest->input('School_Code', ''),
            School_Name: $oRequest->input('School_Name', ''),
            School_Abrv: $oRequest->input('School_Abrv', ''),
            School_Public: (int) $oRequest->input('School_Public', 2),
            School_Status: (int) $oRequest->input('School_Status', 2)
        );
    }
}