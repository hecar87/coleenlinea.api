<?php
namespace App\Modules\Enrollment\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterType;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterNewed;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterStatus;


class SearchEnrollmentBySchoolClassDTO
{
    public function __construct(
        public string $Text = "",
        public EnrollmentFilterType $Type = EnrollmentFilterType::ALL,
        public EnrollmentFilterNewed $Newed = EnrollmentFilterNewed::ALL,
        public EnrollmentFilterStatus $Status = EnrollmentFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $type = match (strtoupper($oRequest->input('Type', 'ALL'))) {
            'REPEATER' => EnrollmentFilterType::REPEATER,
            'PROMOTED' => EnrollmentFilterType::PROMOTED,
            default => EnrollmentFilterType::ALL,
        };

        $newed = match (strtoupper($oRequest->input('Newed', 'ALL'))) {
            'REGULAR' => EnrollmentFilterNewed::REGULAR,
            'NEWED' => EnrollmentFilterNewed::NEWED,
            default => EnrollmentFilterNewed::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => EnrollmentFilterStatus::ACTIVE,
            'INACTIVE' => EnrollmentFilterStatus::INACTIVE,
            default => EnrollmentFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Type: $type,
            Newed: $newed,
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}