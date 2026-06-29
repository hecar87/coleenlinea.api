<?php
namespace App\Modules\Guardian\Application\DTOs;

use Illuminate\Http\Request;

class UpdateGuardianDTO
{
    public function __construct(
        public int $Id_Guardian,
        public string $Guardian_Code,
		public string $Guardian_Name,
		public string $Guardian_LastName,
		public string $Guardian_NoDocument,
		public string $Guardian_DOB,
		public int $Id_TypeDocument,
		public int $Id_TypeGender
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Guardian: (int) $oRequest->input('Id_Guardian', 0),
            Guardian_Code: $oRequest->input('Guardian_Code', ''),
            Guardian_Name: $oRequest->input('Guardian_Name', ''),
            Guardian_LastName: $oRequest->input('Guardian_LastName', ''),
            Guardian_NoDocument: $oRequest->input('Guardian_NoDocument', ''),
            Guardian_DOB: $oRequest->input('Guardian_DOB', ''),
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0),
            Id_TypeGender: (int) $oRequest->input('Id_TypeGender', 0)
        );
    }
}