<?php
namespace App\Modules\SchoolClass\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\SchoolClass\Domain\Enums\SchoolClassFilterDisplay;
use App\Modules\SchoolClass\Domain\Enums\SchoolClassFilterStatus;


class SearchSchoolClassDTO
{
    public function __construct(
        public string $Text = "",
        public SchoolClassFilterDisplay $Display = SchoolClassFilterDisplay::ALL,
        public SchoolClassFilterStatus $Status = SchoolClassFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => SchoolClassFilterDisplay::PUBLIC,
            'PRIVATE' => SchoolClassFilterDisplay::PRIVATE,
            default => SchoolClassFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => SchoolClassFilterStatus::ACTIVE,
            'INACTIVE' => SchoolClassFilterStatus::INACTIVE,
            default => SchoolClassFilterStatus::ALL,
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