<?php
namespace App\Application\TypePayment\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypePayment\Enums\TypePaymentFilterDisplay;
use App\Domain\TypePayment\Enums\TypePaymentFilterStatus;

class SearchTypePaymentDTO
{
    public function __construct(
        public string $Text = "",
        public TypePaymentFilterDisplay $Display = TypePaymentFilterDisplay::ALL,
        public TypePaymentFilterStatus $Status = TypePaymentFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypePaymentFilterDisplay::PUBLIC,
            'PRIVATE' => TypePaymentFilterDisplay::PRIVATE,
            default => TypePaymentFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypePaymentFilterStatus::ACTIVE,
            'INACTIVE' => TypePaymentFilterStatus::INACTIVE,
            default => TypePaymentFilterStatus::ALL,
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