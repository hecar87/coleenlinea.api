<?php
namespace App\Modules\Guardian\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedGuardianDTO
{
    public function __construct(
        public int $Id_Guardian,
		public string $Guardian_NoDocument,
		public int $Id_TypeDocument
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Guardian: (int) $oRequest->input('Id_Guardian', 0),
            Guardian_NoDocument: $oRequest->input('Guardian_NoDocument', ''),
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0)
        );
    }
}