<?php
namespace App\Modules\SchoolAccount\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolAccountDTO
{
    public function __construct(
        public int $Id_SchoolAccount,
        public string $SchoolAccount_Code,
        public string $SchoolAccount_Name,
        public string $SchoolAccount_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolAccount: (int) $oRequest->input('Id_SchoolAccount', 0),
            SchoolAccount_Code: $oRequest->input('SchoolAccount_Code', ''),
            SchoolAccount_Name: $oRequest->input('SchoolAccount_Name', ''),
            SchoolAccount_Abrv: $oRequest->input('SchoolAccount_Abrv', '')
        );
    }
}