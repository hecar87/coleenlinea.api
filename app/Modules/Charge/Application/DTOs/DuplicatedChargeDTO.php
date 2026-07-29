<?php
namespace App\Modules\Charge\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedChargeDTO
{
    public function __construct(
        public int $Id_Charge,
        public string $Charge_NoDocument,
        public int $Id_TypeDocument,
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Charge: (int) $oRequest->input('Id_Charge', 0),
            Charge_NoDocument: $oRequest->input('Charge_NoDocument', ''),
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0)
        );
    }
}