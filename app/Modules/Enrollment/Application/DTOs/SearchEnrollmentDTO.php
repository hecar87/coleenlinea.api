<?php
namespace App\Modules\Enrollment\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterDisplay;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterStatus;


class SearchEnrollmentDTO
{
    public function __construct(
        public string $Text = "",
        public EnrollmentFilterDisplay $Display = EnrollmentFilterDisplay::ALL,
        public EnrollmentFilterStatus $Status = EnrollmentFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => EnrollmentFilterDisplay::PUBLIC,
            'PRIVATE' => EnrollmentFilterDisplay::PRIVATE,
            default => EnrollmentFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => EnrollmentFilterStatus::ACTIVE,
            'INACTIVE' => EnrollmentFilterStatus::INACTIVE,
            default => EnrollmentFilterStatus::ALL,
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