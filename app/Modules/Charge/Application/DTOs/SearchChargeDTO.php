<?php
namespace App\Modules\School\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\School\Domain\Enums\SchoolFilterDisplay;
use App\Modules\School\Domain\Enums\SchoolFilterStatus;


class SearchSchoolDTO
{
    public function __construct(
        public string $Text = "",
        public SchoolFilterDisplay $Display = SchoolFilterDisplay::ALL,
        public SchoolFilterStatus $Status = SchoolFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => SchoolFilterDisplay::PUBLIC,
            'PRIVATE' => SchoolFilterDisplay::PRIVATE,
            default => SchoolFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => SchoolFilterStatus::ACTIVE,
            'INACTIVE' => SchoolFilterStatus::INACTIVE,
            default => SchoolFilterStatus::ALL,
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