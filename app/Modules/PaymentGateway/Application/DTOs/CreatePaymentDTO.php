<?php
namespace App\Modules\PaymentGateway\Application\DTOs;

use Illuminate\Http\Request;

class CreatePaymentDTO
{
    public function __construct(
        public int $Id_Charge,
        public string $Charge_Code,
        public float $Payment_Amount,
        public int $Id_TypeCurrency,
        public string $Payment_ClientIp,
        public string $Payment_Name,
        public string $Payment_LastName,
        public string $Payment_Email,
        public string $Payment_NoDocument,
        public string $Payment_Phone
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Charge: (int) $oRequest->input('Id_Charge', 0),
            Charge_Code: $oRequest->input('Charge_Code', ''),
            Payment_Amount: (float) $oRequest->input('Payment_Amount', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0),
            Payment_ClientIp: $oRequest->input('Payment_ClientIp', ''),
            Payment_Name: $oRequest->input('Payment_Name', ''),
            Payment_LastName: $oRequest->input('Payment_LastName', ''),
            Payment_Email: $oRequest->input('Payment_Email', ''),
            Payment_NoDocument: $oRequest->input('Payment_NoDocument', ''),
            Payment_Phone: $oRequest->input('Payment_Phone', '')
        );
    }
}