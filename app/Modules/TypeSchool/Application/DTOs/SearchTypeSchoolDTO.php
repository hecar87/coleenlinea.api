<?php
namespace App\Application\TypeSchool\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypeSchool\Enums\TypeSchoolFilterDisplay;
use App\Domain\TypeSchool\Enums\TypeSchoolFilterStatus;

class SearchTypeSchoolDTO
{
    public function __construct(
        public string $Text = "",
        public TypeSchoolFilterDisplay $Display = TypeSchoolFilterDisplay::ALL,
        public TypeSchoolFilterStatus $Status = TypeSchoolFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeSchoolFilterDisplay::PUBLIC,
            'PRIVATE' => TypeSchoolFilterDisplay::PRIVATE,
            default => TypeSchoolFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeSchoolFilterStatus::ACTIVE,
            'INACTIVE' => TypeSchoolFilterStatus::INACTIVE,
            default => TypeSchoolFilterStatus::ALL,
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