<?php
namespace App\Modules\Charge\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\Charge\Domain\Enums\ChargeFilterDisplay;
use App\Modules\Charge\Domain\Enums\ChargeFilterStatus;


class SearchChargeDTO
{
    public function __construct(
        public string $Text = "",
        public ChargeFilterDisplay $Display = ChargeFilterDisplay::ALL,
        public ChargeFilterStatus $Status = ChargeFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => ChargeFilterDisplay::PUBLIC,
            'PRIVATE' => ChargeFilterDisplay::PRIVATE,
            default => ChargeFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => ChargeFilterStatus::ACTIVE,
            'INACTIVE' => ChargeFilterStatus::INACTIVE,
            default => ChargeFilterStatus::ALL,
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