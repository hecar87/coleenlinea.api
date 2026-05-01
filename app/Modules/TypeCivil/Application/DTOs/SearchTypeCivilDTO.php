<?php

namespace App\Modules\TypeCivil\Application\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeCivil\Enums\TypeCivilFilterDisplay;
use App\Domain\TypeCivil\Enums\TypeCivilFilterStatus;

class SearchTypeCivilDTO
{
    public function __construct(
        public string $Text = "",
        public TypeCivilFilterDisplay $Display = TypeCivilFilterDisplay::ALL,
        public TypeCivilFilterStatus $Status = TypeCivilFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeCivilFilterDisplay::PUBLIC,
            'PRIVATE' => TypeCivilFilterDisplay::PRIVATE,
            default => TypeCivilFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeCivilFilterStatus::ACTIVE,
            'INACTIVE' => TypeCivilFilterStatus::INACTIVE,
            default => TypeCivilFilterStatus::ALL,
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