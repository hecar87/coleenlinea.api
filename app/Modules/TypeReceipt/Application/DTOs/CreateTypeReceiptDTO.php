<?php

namespace App\Modules\TypeReceipt\Application\DTOs;

use Illuminate\Http\Request;

class CreateTypeReceiptDTO
{
    public function __construct(
        public int $Id_TypeReceipt,
        public string $TypeReceipt_Name,
        public string $TypeReceipt_Abrv,
        public int $TypeReceipt_Public,
        public int $TypeReceipt_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypeReceipt: (int) $oRequest->input('Id_TypeReceipt', 0),
            TypeReceipt_Name: $oRequest->input('TypeReceipt_Name', ''),
            TypeReceipt_Abrv: $oRequest->input('TypeReceipt_Abrv', ''),
            TypeReceipt_Public: (int) $oRequest->input('TypeReceipt_Public', 2),
            TypeReceipt_Status: (int) $oRequest->input('TypeReceipt_Status', 2)
        );
    }
}