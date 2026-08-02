<?php
namespace App\Modules\PaymentGateway\Application\DTOs;

use Illuminate\Http\Request;

class CreatePaymentDTO
{
    public function __construct(
        public int $Id_Charge,
        public string $Charge_Code,
        public float $Amount,
        public string $Currency,
        public string $ClientIp,
        public string $Name,
        public string $LastName,
        public string $Email,
        public string $NoDocument,
        public string $Phone
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Charge: (int) $oRequest->input('Id_Charge', 0),
            Charge_Code: $oRequest->input('Charge_Code', ''),
            Amount: (float) $oRequest->input('Amount', 0),
            Currency: $oRequest->input('Currency', ''),
            ClientIp: $oRequest->input('ClientIp', ''),
            Name: $oRequest->input('Name', ''),
            LastName: $oRequest->input('LastName', ''),
            Email: $oRequest->input('Email', ''),
            NoDocument: $oRequest->input('NoDocument', ''),
            Phone: $oRequest->input('Phone', '')
        );
    }
}