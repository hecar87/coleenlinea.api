<?php

namespace App\Modules\TypeCivil\Application\DTOs;

use Illuminate\Http\Request;

class CreateTypeCivilDTO
{
    public function __construct(
        public int $Id_TypeCivil,
        public string $TypeCivil_Name,
        public string $TypeCivil_Abrv,
        public int $TypeCivil_Public,
        public int $TypeCivil_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeCivil: (int) $oRequest->input('Id_TypeCivil', 0),
            TypeCivil_Name: $oRequest->input('TypeCivil_Name', ''),
            TypeCivil_Abrv: $oRequest->input('TypeCivil_Abrv', ''),
            TypeCivil_Public: (int) $oRequest->input('TypeCivil_Public', 2),
            TypeCivil_Status: (int) $oRequest->input('TypeCivil_Status', 2)
        );
    }
}