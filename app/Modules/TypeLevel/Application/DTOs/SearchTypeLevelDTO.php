<?php
namespace App\Application\TypeLevel\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeLevel\Enums\TypeLevelFilterDisplay;
use App\Domain\TypeLevel\Enums\TypeLevelFilterStatus;

class SearchTypeLevelDTO
{
    public function __construct(
        public string $Text = "",
        public TypeLevelFilterDisplay $Display = TypeLevelFilterDisplay::ALL,
        public TypeLevelFilterStatus $Status = TypeLevelFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeLevelFilterDisplay::PUBLIC,
            'PRIVATE' => TypeLevelFilterDisplay::PRIVATE,
            default => TypeLevelFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeLevelFilterStatus::ACTIVE,
            'INACTIVE' => TypeLevelFilterStatus::INACTIVE,
            default => TypeLevelFilterStatus::ALL,
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