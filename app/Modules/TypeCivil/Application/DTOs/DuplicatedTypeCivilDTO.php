<?php
namespace App\Application\TypeCivil\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeCivilDTO
{
    public function __construct(
        public int $Id_TypeCivil,
        public string $TypeCivil_Name,
        public string $TypeCivil_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeCivil: (int) $oRequest->input('Id_TypeCivil', 0),
            TypeCivil_Name: $oRequest->input('TypeCivil_Name', ''),
            TypeCivil_Abrv: $oRequest->input('TypeCivil_Abrv', '')
        );
    }
}