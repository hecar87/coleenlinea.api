<?php
namespace App\Modules\StudentGuardian\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedStudentGuardianDTO
{
    public function __construct(
        public int $Id_StudentGuardian,
        public int $Id_Student,
		public int $Id_Guardian,
		public int $Id_TypeKinship
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_StudentGuardian: (int) $oRequest->input('Id_StudentGuardian', 0),
            Id_Student: (int) $oRequest->input("Id_Student", 0),
            Id_Guardian: (int) $oRequest->input("Id_Guardian", 0),
            Id_TypeKinship: (int) $oRequest->input("Id_TypeKinship", 0)
        );
    }
}