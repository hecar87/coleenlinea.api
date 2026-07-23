<?php

namespace App\Modules\TypeInstallment\Application\DTOs;

use Illuminate\Http\Request;

class CreateTypeInstallmentDTO
{
    public function __construct(
        public int $Id_TypeInstallment,
        public string $TypeInstallment_Name,
        public string $TypeInstallment_Abrv,
        public int $TypeInstallment_Frequency,
        public int $TypeInstallment_Public,
        public int $TypeInstallment_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeInstallment: (int) $oRequest->input('Id_TypeInstallment', 0),
            TypeInstallment_Name: $oRequest->input('TypeInstallment_Name', ''),
            TypeInstallment_Abrv: $oRequest->input('TypeInstallment_Abrv', ''),
            TypeInstallment_Frequency: (int) $oRequest->input('TypeInstallment_Frequency', 0),
            TypeInstallment_Public: (int) $oRequest->input('TypeInstallment_Public', 2),
            TypeInstallment_Status: (int) $oRequest->input('TypeInstallment_Status', 2)
        );
    }
}