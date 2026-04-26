<?php
namespace App\Application\TypeInstallment\DTOs;

use Illuminate\Http\Request;

class UpdateTypeInstallmentDTO
{
    public function __construct(
        public int $Id_TypeInstallment,
        public string $TypeInstallment_Name,
        public string $TypeInstallment_Abrv,
        public int $TypeInstallment_Public,
        public int $TypeInstallment_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeInstallment: (int) $oRequest->input('Id_TypeInstallment'),
            TypeInstallment_Name: $oRequest->input('TypeInstallment_Name', ''),
            TypeInstallment_Abrv: $oRequest->input('TypeInstallment_Abrv', ''),
            TypeInstallment_Public: (int) $oRequest->input('TypeInstallment_Public', 2),
            TypeInstallment_Status: (int) $oRequest->input('TypeInstallment_Status', 2)
        );
    }
}