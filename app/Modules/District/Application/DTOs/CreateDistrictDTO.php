<?php
namespace App\Application\District\DTOs;

use Illuminate\Http\Request;

class CreateDistrictDTO
{
    public function __construct(
        public int $Id_District,
        public string $District_Code,
        public string $District_Name,
        public int $District_Public,
        public int $District_Status,
        public int $Id_City
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_District: (int) $oRequest->input('Id_District', 0),
            District_Code: $oRequest->input('District_Code', ''),
            District_Name: $oRequest->input('District_Name', ''),
            District_Public: (int) $oRequest->input('District_Public', 2),
            District_Status: (int) $oRequest->input('District_Status', 2),
            Id_City: (int) $oRequest->input('Id_City', 0)
        );
    }
}