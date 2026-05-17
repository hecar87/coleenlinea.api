<?php

namespace App\Modules\TypePayment\Application\DTOs;

use Illuminate\Http\Request;

class CreateTypePaymentDTO
{
    public function __construct(
        public int $Id_TypePayment,
        public string $TypePayment_Name,
        public string $TypePayment_Abrv,
        public int $TypePayment_Public,
        public int $TypePayment_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypePayment: (int) $oRequest->input('Id_TypePayment', 0),
            TypePayment_Name: $oRequest->input('TypePayment_Name', ''),
            TypePayment_Abrv: $oRequest->input('TypePayment_Abrv', ''),
            TypePayment_Public: (int) $oRequest->input('TypePayment_Public', 2),
            TypePayment_Status: (int) $oRequest->input('TypePayment_Status', 2)
        );
    }
}