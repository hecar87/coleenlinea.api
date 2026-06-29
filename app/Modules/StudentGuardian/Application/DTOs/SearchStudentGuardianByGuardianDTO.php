<?php
namespace App\Modules\StudentGuardian\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterVerified;
use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterStatus;


class SearchStudentGuardianByGuardianDTO
{
    public function __construct(
        public string $Text = "",
        public StudentGuardianFilterVerified $Verified = StudentGuardianFilterVerified::ALL,
        public StudentGuardianFilterStatus $Status = StudentGuardianFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $verified = match (strtoupper($oRequest->input('Verified', 'ALL'))) {
            'PENDING' => StudentGuardianFilterVerified::PENDING,
            'VERIFIED' => StudentGuardianFilterVerified::VERIFIED,
            default => StudentGuardianFilterVerified::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => StudentGuardianFilterStatus::ACTIVE,
            'INACTIVE' => StudentGuardianFilterStatus::INACTIVE,
            default => StudentGuardianFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Verified: $verified,
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}