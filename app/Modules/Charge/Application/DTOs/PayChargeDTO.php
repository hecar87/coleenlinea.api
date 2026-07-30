<?php
namespace App\Modules\Charge\Application\DTOs;

use Illuminate\Http\Request;

class PayChargeDTO
{
    public function __construct(
        public int $Id_Charge,
		public string $Charge_Pay_Signature,
		public string $Charge_Pay_Authorization,
		public string $Charge_Pay_Message,
		public string $Charge_Pay_Description,
		public string $Charge_Pay_ECIDescription,
		public string $Charge_Card_Last,
		public string $Charge_Card_Number,
		public string $Charge_Card_Brand,
		public string $Charge_Card_Type,
		public string $Charge_Card_Issuer,
		public string $Charge_Response,
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Charge: (int) $oRequest->input('Id_Charge', 0),
            Charge_Pay_Signature: $oRequest->input('Charge_Pay_Signature', ''),
            Charge_Pay_Authorization: $oRequest->input('Charge_Pay_Authorization', ''),
            Charge_Pay_Message: $oRequest->input('Charge_Pay_Message', ''),
            Charge_Pay_Description: $oRequest->input('Charge_Pay_Description', ''),
            Charge_Pay_ECIDescription: $oRequest->input('Charge_Pay_ECIDescription', ''),
            Charge_Card_Last: $oRequest->input('Charge_Card_Last', ''),
            Charge_Card_Number: $oRequest->input('Charge_Card_Number', ''),
            Charge_Card_Brand: $oRequest->input('Charge_Card_Brand', ''),
            Charge_Card_Type: $oRequest->input('Charge_Card_Type', ''),
            Charge_Card_Issuer: $oRequest->input('Charge_Card_Issuer', ''),
            Charge_Response: $oRequest->input('Charge_Response', '')
        );
    }
}