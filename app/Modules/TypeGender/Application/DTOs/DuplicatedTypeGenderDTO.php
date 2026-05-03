<?php

namespace App\Modules\TypeGender\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeGenderDTO
{
    public function __construct(
        public int $Id_TypeGender,
        public string $TypeGender_Name,
        public string $TypeGender_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeGender: (int) $oRequest->input('Id_TypeGender', 0),
            TypeGender_Name: $oRequest->input('TypeGender_Name', ''),
            TypeGender_Abrv: $oRequest->input('TypeGender_Abrv', '')
        );
    }
}