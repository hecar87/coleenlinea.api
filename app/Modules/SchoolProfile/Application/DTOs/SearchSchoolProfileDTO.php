<?php
namespace App\Modules\SchoolProfile\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\SchoolProfile\Domain\Enums\SchoolProfileFilterDisplay;
use App\Modules\SchoolProfile\Domain\Enums\SchoolProfileFilterStatus;


class SearchSchoolProfileDTO
{
    public function __construct(
        public string $Text = "",
        public SchoolProfileFilterDisplay $Display = SchoolProfileFilterDisplay::ALL,
        public SchoolProfileFilterStatus $Status = SchoolProfileFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => SchoolProfileFilterDisplay::PUBLIC,
            'PRIVATE' => SchoolProfileFilterDisplay::PRIVATE,
            default => SchoolProfileFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => SchoolProfileFilterStatus::ACTIVE,
            'INACTIVE' => SchoolProfileFilterStatus::INACTIVE,
            default => SchoolProfileFilterStatus::ALL,
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