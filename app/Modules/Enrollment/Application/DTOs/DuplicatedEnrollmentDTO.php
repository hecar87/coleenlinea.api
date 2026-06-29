<?php
namespace App\Modules\Enrollment\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedEnrollmentDTO
{
    public function __construct(
        public int $Id_Enrollment,
        public string $Enrollment_Number,
        public string $Enrollment_CCI,
        public int $Id_School,
        public int $Id_TypeBank,
        public int $Id_TypeCurrency
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Enrollment: (int) $oRequest->input('Id_Enrollment', 0),
            Enrollment_Number: $oRequest->input('Enrollment_Number', ''),
            Enrollment_CCI: $oRequest->input('Enrollment_CCI', ''),
            Id_School: (int) $oRequest->input('Id_School', 0),
            Id_TypeBank: (int) $oRequest->input('Id_TypeBank', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0)
        );
    }
}