<?php
namespace App\Modules\StudentGuardian\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterDisplay;
use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterStatus;


class SearchStudentGuardianDTO
{
    public function __construct(
        public string $Text = "",
        public StudentGuardianFilterDisplay $Display = StudentGuardianFilterDisplay::ALL,
        public StudentGuardianFilterStatus $Status = StudentGuardianFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => StudentGuardianFilterDisplay::PUBLIC,
            'PRIVATE' => StudentGuardianFilterDisplay::PRIVATE,
            default => StudentGuardianFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => StudentGuardianFilterStatus::ACTIVE,
            'INACTIVE' => StudentGuardianFilterStatus::INACTIVE,
            default => StudentGuardianFilterStatus::ALL,
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