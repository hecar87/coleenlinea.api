<?php
namespace App\Modules\Charge\Application\DTOs;

use Illuminate\Http\Request;

class CreateChargeDTO
{
    public function __construct(
        public int $Id_Charge,
        public string $Charge_BusinessName,
        public string $Charge_TradeName,
        public string $Charge_NoDocument,
        public string $Charge_Address,
        public string $Charge_Phone,
        public int $Charge_Public,
        public int $Charge_Status,
        public int $Id_State,
        public int $Id_City,
        public int $Id_District,
        public int $Id_TypeDocument,
        public int $Id_TypePopulation,
        public int $Id_TypeCharge
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Charge: (int) $oRequest->input('Id_Charge', 0),
            Charge_BusinessName: $oRequest->input('Charge_BusinessName', ''),
            Charge_TradeName: $oRequest->input('Charge_TradeName', ''),
            Charge_NoDocument: $oRequest->input('Charge_NoDocument', ''),
            Charge_Address: $oRequest->input('Charge_Address', ''),
            Charge_Phone: $oRequest->input('Charge_Phone', ''),
            Charge_Public: (int) $oRequest->input('Charge_Public', 2),
            Charge_Status: (int) $oRequest->input('Charge_Status', 2),
            Id_State: (int) $oRequest->input('Id_State', 0),
            Id_City: (int) $oRequest->input('Id_City', 0),
            Id_District: (int) $oRequest->input('Id_District', 0),
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0),
            Id_TypePopulation: (int) $oRequest->input('Id_TypePopulation', 0),
            Id_TypeCharge: (int) $oRequest->input('Id_TypeCharge', 0)
        );
    }
}