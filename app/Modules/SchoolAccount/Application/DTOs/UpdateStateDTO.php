<?php
namespace App\Modules\SchoolAccount\Application\DTOs;

use Illuminate\Http\Request;

class UpdateSchoolAccountDTO
{
    public function __construct(
        public int $Id_SchoolAccount,
        public string $SchoolAccount_Code,
        public string $SchoolAccount_Name,
        public string $SchoolAccount_Abrv,
        public int $SchoolAccount_Public,
        public int $SchoolAccount_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolAccount: (int) $oRequest->input('Id_SchoolAccount'),
            SchoolAccount_Code: $oRequest->input('SchoolAccount_Code', ''),
            SchoolAccount_Name: $oRequest->input('SchoolAccount_Name', ''),
            SchoolAccount_Abrv: $oRequest->input('SchoolAccount_Abrv', ''),
            SchoolAccount_Public: (int) $oRequest->input('SchoolAccount_Public', 2),
            SchoolAccount_Status: (int) $oRequest->input('SchoolAccount_Status', 2)
        );
    }
}