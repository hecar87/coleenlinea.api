<?php
namespace App\Modules\ContractFee\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\ContractFee\Domain\Enums\ContractFeeFilterDisplay;
use App\Modules\ContractFee\Domain\Enums\ContractFeeFilterStatus;


class SearchContractFeeDTO
{
    public function __construct(
        public string $Text = "",
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}