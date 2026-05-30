<?php
namespace App\Modules\School\Application\DTOs;

use Illuminate\Http\Request;

class CreateSchoolDTO
{
    public function __construct(
        public int $Id_School,
        public string $School_Code,
        public string $School_BusinessName,
        public string $School_TradeName,
        public string $School_NoDocument,
        public string $School_Address,
        public string $School_Phone,
        public int $School_Public,
        public int $School_Status,
        public int $Id_State,
        public int $Id_City,
        public int $Id_District,
        public int $Id_TypeDocument,
        public int $Id_TypePopulation,
        public int $Id_TypeSchool
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_School: (int) $oRequest->input('Id_School', 0),
            School_Code: $oRequest->input('School_Code', ''),
            School_BusinessName: $oRequest->input('School_BusinessName', ''),
            School_TradeName: $oRequest->input('School_TradeName', ''),
            School_NoDocument: $oRequest->input('School_NoDocument', ''),
            School_Address: $oRequest->input('School_Address', ''),
            School_Phone: $oRequest->input('School_Phone', ''),
            School_Public: (int) $oRequest->input('School_Public', 2),
            School_Status: (int) $oRequest->input('School_Status', 2),
            Id_State: (int) $oRequest->input('Id_State', 0),
            Id_City: (int) $oRequest->input('Id_City', 0),
            Id_District: (int) $oRequest->input('Id_District', 0),
            Id_TypeDocument: (int) $oRequest->input('Id_TypeDocument', 0),
            Id_TypePopulation: (int) $oRequest->input('Id_TypePopulation', 0),
            Id_TypeSchool: (int) $oRequest->input('Id_TypeSchool', 0)
        );
    }
}