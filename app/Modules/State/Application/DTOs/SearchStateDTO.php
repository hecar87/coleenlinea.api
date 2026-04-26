<?php
namespace App\Application\State\DTOs;

use Illuminate\Http\Request;
use App\Domain\State\Enums\StateFilterDisplay;
use App\Domain\State\Enums\StateFilterStatus;

class SearchStateDTO
{
    public function __construct(
        public string $Text = "",
        public StateFilterDisplay $Display = StateFilterDisplay::ALL,
        public StateFilterStatus $Status = StateFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => StateFilterDisplay::PUBLIC,
            'PRIVATE' => StateFilterDisplay::PRIVATE,
            default => StateFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => StateFilterStatus::ACTIVE,
            'INACTIVE' => StateFilterStatus::INACTIVE,
            default => StateFilterStatus::ALL,
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