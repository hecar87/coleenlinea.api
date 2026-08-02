<?php
namespace App\Modules\PaymentGateway\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayFilterDisplay;
use App\Modules\PaymentGateway\Domain\Enums\PaymentGatewayFilterStatus;


class SearchPaymentGatewayDTO
{
    public function __construct(
        public string $Text = "",
        public PaymentGatewayFilterDisplay $Display = PaymentGatewayFilterDisplay::ALL,
        public PaymentGatewayFilterStatus $Status = PaymentGatewayFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => PaymentGatewayFilterDisplay::PUBLIC,
            'PRIVATE' => PaymentGatewayFilterDisplay::PRIVATE,
            default => PaymentGatewayFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => PaymentGatewayFilterStatus::ACTIVE,
            'INACTIVE' => PaymentGatewayFilterStatus::INACTIVE,
            default => PaymentGatewayFilterStatus::ALL,
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