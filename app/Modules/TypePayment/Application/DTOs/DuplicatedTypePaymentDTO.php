<?php
namespace App\Application\TypePayment\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypePaymentDTO
{
    public function __construct(
        public int $Id_TypePayment,
        public string $TypePayment_Name,
        public string $TypePayment_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypePayment: (int) $oRequest->input('Id_TypePayment', 0),
            TypePayment_Name: $oRequest->input('TypePayment_Name', ''),
            TypePayment_Abrv: $oRequest->input('TypePayment_Abrv', '')
        );
    }
}