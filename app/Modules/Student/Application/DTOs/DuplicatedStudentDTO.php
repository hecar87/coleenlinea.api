<?php
namespace App\Modules\Student\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedStudentDTO
{
    public function __construct(
        public int $Id_Student,
		public string $Student_NoDocument,
		public int $Id_TypeDocument
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Student: (int) $oRequest->input('Id_Student', 0),
            Student_NoDocument: $oRequest->input('Student_NoDocument', ''),
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0)
        );
    }
}