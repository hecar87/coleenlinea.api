<?php
namespace App\Modules\PaymentGateway\Application\DTOs;

use Illuminate\Http\Request;

class AuthorizePaymentDTO
{
    public function __construct(
        public int $Id_Charge,
        public string $Charge_Code,
        public string $Payment_Token
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Charge: (int) $oRequest->input('Id_Charge', 0),
            Charge_Code: $oRequest->input('Charge_Code', ''),
            Payment_Token: $oRequest->input('Payment_Token', '')
        );
    }
}