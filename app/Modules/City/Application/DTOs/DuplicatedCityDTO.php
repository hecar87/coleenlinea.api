<?php
namespace App\Application\City\DTOs;

use Illuminate\Http\Request;

class DuplicatedCityDTO
{
    public function __construct(
        public int $Id_City,
        public string $City_Code,
        public string $City_Name,
        public int $Id_State
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_City: (int) $oRequest->input('Id_City', 0),
            City_Code: $oRequest->input('City_Code', ''),
            City_Name: $oRequest->input('City_Name', ''),
            Id_State: (int) $oRequest->input('Id_State', 0)
        );
    }
}