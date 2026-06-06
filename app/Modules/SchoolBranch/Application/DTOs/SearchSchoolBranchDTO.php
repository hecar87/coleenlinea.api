<?php
namespace App\Modules\SchoolBranch\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\SchoolBranch\Domain\Enums\SchoolBranchFilterDisplay;
use App\Modules\SchoolBranch\Domain\Enums\SchoolBranchFilterStatus;


class SearchSchoolBranchDTO
{
    public function __construct(
        public string $Text = "",
        public SchoolBranchFilterDisplay $Display = SchoolBranchFilterDisplay::ALL,
        public SchoolBranchFilterStatus $Status = SchoolBranchFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => SchoolBranchFilterDisplay::PUBLIC,
            'PRIVATE' => SchoolBranchFilterDisplay::PRIVATE,
            default => SchoolBranchFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => SchoolBranchFilterStatus::ACTIVE,
            'INACTIVE' => SchoolBranchFilterStatus::INACTIVE,
            default => SchoolBranchFilterStatus::ALL,
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