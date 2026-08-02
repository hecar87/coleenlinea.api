<?php
namespace App\Modules\PaymentGateway\Application\DTOs;

use Illuminate\Http\Request;

class CreatePaymentGatewayDTO
{
    public function __construct(
        public int $Id_PaymentGateway,
        public string $PaymentGateway_Code,
        public string $PaymentGateway_Name,
        public string $PaymentGateway_Abrv,
        public int $PaymentGateway_Public,
        public int $PaymentGateway_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_PaymentGateway: (int) $oRequest->input('Id_PaymentGateway', 0),
            PaymentGateway_Code: $oRequest->input('PaymentGateway_Code', ''),
            PaymentGateway_Name: $oRequest->input('PaymentGateway_Name', ''),
            PaymentGateway_Abrv: $oRequest->input('PaymentGateway_Abrv', ''),
            PaymentGateway_Public: (int) $oRequest->input('PaymentGateway_Public', 2),
            PaymentGateway_Status: (int) $oRequest->input('PaymentGateway_Status', 2)
        );
    }
}