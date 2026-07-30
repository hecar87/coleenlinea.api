<?php
namespace App\Modules\Charge\Application\DTOs;

use Illuminate\Http\Request;

class CreateChargeDTO
{
    public function __construct(
        public int $Id_Charge,
        public string $Charge_Name,
        public string $Charge_LastName,
        public string $Charge_Email,
        public string $Charge_NoDocument,
        public string $Charge_Phone,
        public int $Id_Guardian,
        public int $Id_TypeCurrency,
        public int $Id_TypePayment
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Charge: (int) $oRequest->input('Id_Charge', 0),
            Charge_Name: $oRequest->input('Charge_Name', ''),
            Charge_LastName: $oRequest->input('Charge_LastName', ''),
            Charge_Email: $oRequest->input('Charge_Email', ''),
            Charge_NoDocument: $oRequest->input('Charge_NoDocument', ''),
            Charge_Phone: $oRequest->input('Charge_Phone', ''),
            Id_Guardian: (int) $oRequest->input('Id_Guardian', 0),
            Id_TypeCurrency: (int) $oRequest->input('Id_TypeCurrency', 0),
            Id_TypePayment: (int) $oRequest->input('Id_TypePayment', 0)
        );
    }
}