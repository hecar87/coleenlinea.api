<?php
namespace App\Application\State\DTOs;

use Illuminate\Http\Request;

class DuplicatedStateDTO
{
    public function __construct(
        public int $Id_State,
        public string $State_Code,
        public string $State_Name,
        public string $State_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_State: (int) $oRequest->input('Id_State', 0),
            State_Code: $oRequest->input('State_Code', ''),
            State_Name: $oRequest->input('State_Name', ''),
            State_Abrv: $oRequest->input('State_Abrv', '')
        );
    }
}