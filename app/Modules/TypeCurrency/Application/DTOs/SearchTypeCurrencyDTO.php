<?php

namespace App\Modules\TypeCurrency\Application\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeCurrency\Enums\TypeCurrencyFilterDisplay;
use App\Domain\TypeCurrency\Enums\TypeCurrencyFilterStatus;

class SearchTypeCurrencyDTO
{
    public function __construct(
        public string $Text = "",
        public TypeCurrencyFilterDisplay $Display = TypeCurrencyFilterDisplay::ALL,
        public TypeCurrencyFilterStatus $Status = TypeCurrencyFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeCurrencyFilterDisplay::PUBLIC,
            'PRIVATE' => TypeCurrencyFilterDisplay::PRIVATE,
            default => TypeCurrencyFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeCurrencyFilterStatus::ACTIVE,
            'INACTIVE' => TypeCurrencyFilterStatus::INACTIVE,
            default => TypeCurrencyFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Display: $display,
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}