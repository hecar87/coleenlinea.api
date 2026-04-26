<?php
namespace App\Application\TypeBank\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeBank\Enums\TypeBankFilterDisplay;
use App\Domain\TypeBank\Enums\TypeBankFilterStatus;

class SearchTypeBankDTO
{
    public function __construct(
        public string $Text = "",
        public TypeBankFilterDisplay $Display = TypeBankFilterDisplay::ALL,
        public TypeBankFilterStatus $Status = TypeBankFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeBankFilterDisplay::PUBLIC,
            'PRIVATE' => TypeBankFilterDisplay::PRIVATE,
            default => TypeBankFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeBankFilterStatus::ACTIVE,
            'INACTIVE' => TypeBankFilterStatus::INACTIVE,
            default => TypeBankFilterStatus::ALL,
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