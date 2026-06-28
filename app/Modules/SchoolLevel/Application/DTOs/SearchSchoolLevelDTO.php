<?php
namespace App\Modules\SchoolLevel\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\SchoolLevel\Domain\Enums\SchoolLevelFilterDisplay;
use App\Modules\SchoolLevel\Domain\Enums\SchoolLevelFilterStatus;


class SearchSchoolLevelDTO
{
    public function __construct(
        public string $Text = "",
        public SchoolLevelFilterDisplay $Display = SchoolLevelFilterDisplay::ALL,
        public SchoolLevelFilterStatus $Status = SchoolLevelFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input("Display", "ALL"))) {
            "PUBLIC" => SchoolLevelFilterDisplay::PUBLIC,
            "PRIVATE" => SchoolLevelFilterDisplay::PRIVATE,
            default => SchoolLevelFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input("Status", "ALL"))) {
            "ACTIVE" => SchoolLevelFilterStatus::ACTIVE,
            "INACTIVE" => SchoolLevelFilterStatus::INACTIVE,
            default => SchoolLevelFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input("Text", ""),
            Display: $display,
            Status: $status,
            Page_Size: (int) $oRequest->input("Page_Size", 10),
            Page_Current: (int) $oRequest->input("Page_Current", 1)
        );
    }
}