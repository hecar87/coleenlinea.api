<?php

namespace App\Modules\TypeFee\Application\DTOs;

use Illuminate\Http\Request;

class UpdateTypeFeeDTO
{
    public function __construct(
        public int $Id_TypeFee,
        public string $TypeFee_Name,
        public string $TypeFee_Abrv,
        public int $TypeFee_Public,
        public int $TypeFee_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeFee: (int) $oRequest->input('Id_TypeFee'),
            TypeFee_Name: $oRequest->input('TypeFee_Name', ''),
            TypeFee_Abrv: $oRequest->input('TypeFee_Abrv', ''),
            TypeFee_Public: (int) $oRequest->input('TypeFee_Public', 2),
            TypeFee_Status: (int) $oRequest->input('TypeFee_Status', 2)
        );
    }
}