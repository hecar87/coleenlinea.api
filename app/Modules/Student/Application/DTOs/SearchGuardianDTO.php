<?php
namespace App\Modules\Guardian\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\Guardian\Domain\Enums\GuardianFilterVerified;
use App\Modules\Guardian\Domain\Enums\GuardianFilterStatus;


class SearchGuardianDTO
{
    public function __construct(
        public string $Text = "",
        public GuardianFilterVerified $Verified = GuardianFilterVerified::ALL,
        public GuardianFilterStatus $Status = GuardianFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $verified = match (strtoupper($oRequest->input('Verified', 'ALL'))) {
            'PENDING' => GuardianFilterVerified::PENDING,
            'VERIFIED' => GuardianFilterVerified::VERIFIED,
            default => GuardianFilterVerified::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => GuardianFilterStatus::ACTIVE,
            'INACTIVE' => GuardianFilterStatus::INACTIVE,
            default => GuardianFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Verified: $verified,
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}