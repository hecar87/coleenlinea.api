<?php
namespace App\Application\TypeReceipt\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeReceipt\Enums\TypeReceiptFilterDisplay;
use App\Domain\TypeReceipt\Enums\TypeReceiptFilterStatus;

class SearchTypeReceiptDTO
{
    public function __construct(
        public string $Text = "",
        public TypeReceiptFilterDisplay $Display = TypeReceiptFilterDisplay::ALL,
        public TypeReceiptFilterStatus $Status = TypeReceiptFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeReceiptFilterDisplay::PUBLIC,
            'PRIVATE' => TypeReceiptFilterDisplay::PRIVATE,
            default => TypeReceiptFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeReceiptFilterStatus::ACTIVE,
            'INACTIVE' => TypeReceiptFilterStatus::INACTIVE,
            default => TypeReceiptFilterStatus::ALL,
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