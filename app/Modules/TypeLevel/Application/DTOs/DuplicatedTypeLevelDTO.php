<?php

namespace App\Modules\TypeLevel\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeLevelDTO
{
    public function __construct(
        public int $Id_TypeLevel,
        public string $TypeLevel_Name,
        public string $TypeLevel_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeLevel: (int) $oRequest->input('Id_TypeLevel', 0),
            TypeLevel_Name: $oRequest->input('TypeLevel_Name', ''),
            TypeLevel_Abrv: $oRequest->input('TypeLevel_Abrv', '')
        );
    }
}