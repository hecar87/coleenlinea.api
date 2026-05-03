<?php

namespace App\Modules\TypeInstallment\Application\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeInstallment\Enums\TypeInstallmentFilterDisplay;
use App\Domain\TypeInstallment\Enums\TypeInstallmentFilterStatus;

class SearchTypeInstallmentDTO
{
    public function __construct(
        public string $Text = "",
        public TypeInstallmentFilterDisplay $Display = TypeInstallmentFilterDisplay::ALL,
        public TypeInstallmentFilterStatus $Status = TypeInstallmentFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeInstallmentFilterDisplay::PUBLIC,
            'PRIVATE' => TypeInstallmentFilterDisplay::PRIVATE,
            default => TypeInstallmentFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeInstallmentFilterStatus::ACTIVE,
            'INACTIVE' => TypeInstallmentFilterStatus::INACTIVE,
            default => TypeInstallmentFilterStatus::ALL,
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