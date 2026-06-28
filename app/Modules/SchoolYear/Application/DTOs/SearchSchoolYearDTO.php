<?php
namespace App\Modules\SchoolYear\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\SchoolYear\Domain\Enums\SchoolYearFilterDisplay;
use App\Modules\SchoolYear\Domain\Enums\SchoolYearFilterStatus;


class SearchSchoolYearDTO
{
    public function __construct(
        public string $Text = "",
        public SchoolYearFilterStatus $Status = SchoolYearFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => SchoolYearFilterStatus::ACTIVE,
            'INACTIVE' => SchoolYearFilterStatus::INACTIVE,
            default => SchoolYearFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}