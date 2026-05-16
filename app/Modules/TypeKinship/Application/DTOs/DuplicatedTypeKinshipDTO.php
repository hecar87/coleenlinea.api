<?php

namespace App\Modules\TypeKinship\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeKinshipDTO
{
    public function __construct(
        public int $Id_TypeKinship,
        public string $TypeKinship_Name,
        public string $TypeKinship_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeKinship: (int) $oRequest->input('Id_TypeKinship', 0),
            TypeKinship_Name: $oRequest->input('TypeKinship_Name', ''),
            TypeKinship_Abrv: $oRequest->input('TypeKinship_Abrv', '')
        );
    }
}