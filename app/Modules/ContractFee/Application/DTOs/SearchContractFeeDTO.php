<?php
namespace App\Modules\ContractFee\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\ContractFee\Domain\Enums\ContractFeeFilterDisplay;
use App\Modules\ContractFee\Domain\Enums\ContractFeeFilterStatus;


class SearchContractFeeDTO
{
    public function __construct(
        public string $Text = "",
        public ContractFeeFilterDisplay $Display = ContractFeeFilterDisplay::ALL,
        public ContractFeeFilterStatus $Status = ContractFeeFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => ContractFeeFilterDisplay::PUBLIC,
            'PRIVATE' => ContractFeeFilterDisplay::PRIVATE,
            default => ContractFeeFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => ContractFeeFilterStatus::ACTIVE,
            'INACTIVE' => ContractFeeFilterStatus::INACTIVE,
            default => ContractFeeFilterStatus::ALL,
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