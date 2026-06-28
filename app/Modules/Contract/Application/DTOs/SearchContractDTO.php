<?php
namespace App\Modules\Contract\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\Contract\Domain\Enums\ContractFilterDisplay;
use App\Modules\Contract\Domain\Enums\ContractFilterStatus;


class SearchContractDTO
{
    public function __construct(
        public string $Text = "",
        public ContractFilterDisplay $Display = ContractFilterDisplay::ALL,
        public ContractFilterStatus $Status = ContractFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => ContractFilterDisplay::PUBLIC,
            'PRIVATE' => ContractFilterDisplay::PRIVATE,
            default => ContractFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => ContractFilterStatus::ACTIVE,
            'INACTIVE' => ContractFilterStatus::INACTIVE,
            default => ContractFilterStatus::ALL,
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