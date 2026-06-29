<?php
namespace App\Modules\Student\Application\DTOs;

use Illuminate\Http\Request;

class UpdateStudentDTO
{
    public function __construct(
        public int $Id_Student,
        public string $Student_Code,
		public string $Student_Name,
		public string $Student_LastName,
		public string $Student_NoDocument,
		public string $Student_DOB,
		public int $Id_TypeDocument,
		public int $Id_TypeGender
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Student: (int) $oRequest->input('Id_Student', 0),
            Student_Code: $oRequest->input('Student_Code', ''),
            Student_Name: $oRequest->input('Student_Name', ''),
            Student_LastName: $oRequest->input('Student_LastName', ''),
            Student_NoDocument: $oRequest->input('Student_NoDocument', ''),
            Student_DOB: $oRequest->input('Student_DOB', ''),
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0),
            Id_TypeGender: (int) $oRequest->input('Id_TypeGender', 0)
        );
    }
}