<?php

namespace App\Modules\TypeGender\Application\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeGender\Enums\TypeGenderFilterDisplay;
use App\Domain\TypeGender\Enums\TypeGenderFilterStatus;

class SearchTypeGenderDTO
{
    public function __construct(
        public string $Text = "",
        public TypeGenderFilterDisplay $Display = TypeGenderFilterDisplay::ALL,
        public TypeGenderFilterStatus $Status = TypeGenderFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeGenderFilterDisplay::PUBLIC,
            'PRIVATE' => TypeGenderFilterDisplay::PRIVATE,
            default => TypeGenderFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeGenderFilterStatus::ACTIVE,
            'INACTIVE' => TypeGenderFilterStatus::INACTIVE,
            default => TypeGenderFilterStatus::ALL,
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