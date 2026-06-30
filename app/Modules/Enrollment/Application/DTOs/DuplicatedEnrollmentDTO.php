<?php
namespace App\Modules\Enrollment\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedEnrollmentDTO
{
    public function __construct(
        public int $Id_Enrollment,
		public int $Id_School,
		public int $Id_SchoolYear,
		public int $Id_SchoolClass,
		public int $Id_Student
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Enrollment: (int) $oRequest->input("Id_Enrollment", 0),
            Id_School: (int) $oRequest->input("Id_School", 0),
            Id_SchoolYear: (int) $oRequest->input("Id_SchoolYear", 0),
            Id_SchoolClass: (int) $oRequest->input("Id_SchoolClass", 0),
            Id_Student: (int) $oRequest->input("Id_Student", 0)
        );
    }
}