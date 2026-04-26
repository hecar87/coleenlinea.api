<?php
namespace App\Application\TypeKinship\DTOs;

use Illuminate\Http\Request;

class UpdateTypeKinshipDTO
{
    public function __construct(
        public int $Id_TypeKinship,
        public string $TypeKinship_Name,
        public string $TypeKinship_Abrv,
        public int $TypeKinship_Public,
        public int $TypeKinship_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeKinship: (int) $oRequest->input('Id_TypeKinship'),
            TypeKinship_Name: $oRequest->input('TypeKinship_Name', ''),
            TypeKinship_Abrv: $oRequest->input('TypeKinship_Abrv', ''),
            TypeKinship_Public: (int) $oRequest->input('TypeKinship_Public', 2),
            TypeKinship_Status: (int) $oRequest->input('TypeKinship_Status', 2)
        );
    }
}