<?php
namespace App\Application\TypeGender\DTOs;

use Illuminate\Http\Request;

class UpdateTypeGenderDTO
{
    public function __construct(
        public int $Id_TypeGender,
        public string $TypeGender_Name,
        public string $TypeGender_Abrv,
        public int $TypeGender_Public,
        public int $TypeGender_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeGender: (int) $oRequest->input('Id_TypeGender'),
            TypeGender_Name: $oRequest->input('TypeGender_Name', ''),
            TypeGender_Abrv: $oRequest->input('TypeGender_Abrv', ''),
            TypeGender_Public: (int) $oRequest->input('TypeGender_Public', 2),
            TypeGender_Status: (int) $oRequest->input('TypeGender_Status', 2)
        );
    }
}