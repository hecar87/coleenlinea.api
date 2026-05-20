<?php

namespace App\Modules\TypeSchool\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeSchoolDTO
{
    public function __construct(
        public int $Id_TypeSchool,
        public string $TypeSchool_Name,
        public string $TypeSchool_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeSchool: (int) $oRequest->input('Id_TypeSchool', 0),
            TypeSchool_Name: $oRequest->input('TypeSchool_Name', ''),
            TypeSchool_Abrv: $oRequest->input('TypeSchool_Abrv', '')
        );
    }
}