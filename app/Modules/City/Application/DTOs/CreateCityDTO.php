<?php
namespace App\Application\City\DTOs;

use Illuminate\Http\Request;

class CreateCityDTO
{
    public function __construct(
        public int $Id_City,
        public string $City_Code,
        public string $City_Name,
        public int $City_Public,
        public int $City_Status,
        public int $Id_State
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_City: (int) $oRequest->input('Id_City', 0),
            City_Code: $oRequest->input('City_Code', ''),
            City_Name: $oRequest->input('City_Name', ''),
            City_Public: (int) $oRequest->input('City_Public', 2),
            City_Status: (int) $oRequest->input('City_Status', 2),
            Id_State: (int) $oRequest->input('Id_State', 0)
        );
    }
}