<?php
namespace App\Modules\School\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedSchoolDTO
{
    public function __construct(
        public int $Id_School,
        public string $School_NoDocument,
        public int $Id_TypeDocument,
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_School: (int) $oRequest->input('Id_School', 0),
            School_NoDocument: $oRequest->input('School_NoDocument', ''),
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0)
        );
    }
}