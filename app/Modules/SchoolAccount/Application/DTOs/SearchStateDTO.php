<?php
namespace App\Modules\SchoolAccount\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountFilterDisplay;
use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountFilterStatus;


class SearchSchoolAccountDTO
{
    public function __construct(
        public string $Text = "",
        public SchoolAccountFilterDisplay $Display = SchoolAccountFilterDisplay::ALL,
        public SchoolAccountFilterStatus $Status = SchoolAccountFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => SchoolAccountFilterDisplay::PUBLIC,
            'PRIVATE' => SchoolAccountFilterDisplay::PRIVATE,
            default => SchoolAccountFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => SchoolAccountFilterStatus::ACTIVE,
            'INACTIVE' => SchoolAccountFilterStatus::INACTIVE,
            default => SchoolAccountFilterStatus::ALL,
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