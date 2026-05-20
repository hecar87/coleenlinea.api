<?php

namespace App\Modules\TypeSchool\Application\DTOs;

use Illuminate\Http\Request;

class UpdateTypeSchoolDTO
{
    public function __construct(
        public int $Id_TypeSchool,
        public string $TypeSchool_Name,
        public string $TypeSchool_Abrv,
        public int $TypeSchool_Public,
        public int $TypeSchool_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeSchool: (int) $oRequest->input('Id_TypeSchool'),
            TypeSchool_Name: $oRequest->input('TypeSchool_Name', ''),
            TypeSchool_Abrv: $oRequest->input('TypeSchool_Abrv', ''),
            TypeSchool_Public: (int) $oRequest->input('TypeSchool_Public', 2),
            TypeSchool_Status: (int) $oRequest->input('TypeSchool_Status', 2)
        );
    }
}