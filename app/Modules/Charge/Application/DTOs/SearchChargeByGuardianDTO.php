<?php
namespace App\Modules\Charge\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\Charge\Domain\Enums\ChargeFilterStatus;


class SearchChargeByGuardianDTO
{
    public function __construct(
        public string $Text = "",
        public ChargeFilterStatus $Status = ChargeFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => ChargeFilterStatus::ACTIVE,
            'INACTIVE' => ChargeFilterStatus::INACTIVE,
			'NULLIFIED' => ChargeFilterStatus::NULLIFIED,
            default => ChargeFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}