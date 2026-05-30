<?php
namespace App\Modules\State\Application\DTOs;

use Illuminate\Http\Request;

class CreateStateDTO
{
    public function __construct(
        public int $Id_State,
        public string $State_Code,
        public string $State_Name,
        public string $State_Abrv,
        public int $State_Public,
        public int $State_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_State: (int) $oRequest->input('Id_State', 0),
            State_Code: $oRequest->input('State_Code', ''),
            State_Name: $oRequest->input('State_Name', ''),
            State_Abrv: $oRequest->input('State_Abrv', ''),
            State_Public: (int) $oRequest->input('State_Public', 2),
            State_Status: (int) $oRequest->input('State_Status', 2)
        );
    }
}