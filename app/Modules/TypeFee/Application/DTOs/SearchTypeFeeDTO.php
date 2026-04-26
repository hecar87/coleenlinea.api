<?php
namespace App\Application\TypeFee\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeFee\Enums\TypeFeeFilterDisplay;
use App\Domain\TypeFee\Enums\TypeFeeFilterStatus;

class SearchTypeFeeDTO
{
    public function __construct(
        public string $Text = "",
        public TypeFeeFilterDisplay $Display = TypeFeeFilterDisplay::ALL,
        public TypeFeeFilterStatus $Status = TypeFeeFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeFeeFilterDisplay::PUBLIC,
            'PRIVATE' => TypeFeeFilterDisplay::PRIVATE,
            default => TypeFeeFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeFeeFilterStatus::ACTIVE,
            'INACTIVE' => TypeFeeFilterStatus::INACTIVE,
            default => TypeFeeFilterStatus::ALL,
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