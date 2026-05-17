<?php

namespace App\Modules\TypeReceipt\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypeReceiptDTO
{
    public function __construct(
        public int $Id_TypeReceipt,
        public string $TypeReceipt_Name,
        public string $TypeReceipt_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeReceipt: (int) $oRequest->input('Id_TypeReceipt', 0),
            TypeReceipt_Name: $oRequest->input('TypeReceipt_Name', ''),
            TypeReceipt_Abrv: $oRequest->input('TypeReceipt_Abrv', '')
        );
    }
}