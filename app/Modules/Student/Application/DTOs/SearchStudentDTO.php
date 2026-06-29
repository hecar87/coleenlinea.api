<?php
namespace App\Modules\Student\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\Student\Domain\Enums\StudentFilterVerified;
use App\Modules\Student\Domain\Enums\StudentFilterStatus;


class SearchStudentDTO
{
    public function __construct(
        public string $Text = "",
        public StudentFilterVerified $Verified = StudentFilterVerified::ALL,
        public StudentFilterStatus $Status = StudentFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $verified = match (strtoupper($oRequest->input('Verified', 'ALL'))) {
            'PENDING' => StudentFilterVerified::PENDING,
            'VERIFIED' => StudentFilterVerified::VERIFIED,
            default => StudentFilterVerified::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => StudentFilterStatus::ACTIVE,
            'INACTIVE' => StudentFilterStatus::INACTIVE,
            default => StudentFilterStatus::ALL,
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