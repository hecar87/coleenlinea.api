<?php

namespace App\Modules\TypeInstallment\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeInstallmentDTO
{
    public function __construct(
        public int $Id_TypeInstallment,
        public string $TypeInstallment_Name,
        public string $TypeInstallment_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeInstallment: (int) $oRequest->input('Id_TypeInstallment', 0),
            TypeInstallment_Name: $oRequest->input('TypeInstallment_Name', ''),
            TypeInstallment_Abrv: $oRequest->input('TypeInstallment_Abrv', '')
        );
    }
}