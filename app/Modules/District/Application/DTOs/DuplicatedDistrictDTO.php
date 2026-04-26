<?php

namespace App\Modules\District\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedDistrictDTO
{
    public function __construct(
        public int $Id_District,
        public string $District_Code,
        public string $District_Name,
        public int $Id_City
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_District: (int) $oRequest->input('Id_District', 0),
            District_Code: $oRequest->input('District_Code', ''),
            District_Name: $oRequest->input('District_Name', ''),
            Id_City: (int) $oRequest->input('Id_City', 0)
        );
    }
}