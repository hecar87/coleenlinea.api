<?php
namespace App\Application\TypeFee\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeFeeDTO
{
    public function __construct(
        public int $Id_TypeFee,
        public string $TypeFee_Name,
        public string $TypeFee_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeFee: (int) $oRequest->input('Id_TypeFee', 0),
            TypeFee_Name: $oRequest->input('TypeFee_Name', ''),
            TypeFee_Abrv: $oRequest->input('TypeFee_Abrv', '')
        );
    }
}