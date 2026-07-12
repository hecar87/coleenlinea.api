<?php
namespace App\Modules\SchoolAccount\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolAccountDTO
{
    public function __construct(
        public int $Id_SchoolAccount,
        public string $SchoolAccount_Number,
        public string $SchoolAccount_CCI,
        public int $Id_School,
        public int $Id_TypeBank,
        public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_SchoolAccount: (int) $oRequest->input('Id_SchoolAccount', 0),
            SchoolAccount_Number: $oRequest->input('SchoolAccount_Number', ''),
            SchoolAccount_CCI: $oRequest->input('SchoolAccount_CCI', ''),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}