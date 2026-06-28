<?php
namespace App\Modules\SchoolInstallment\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\SchoolInstallment\Domain\Enums\SchoolInstallmentFilterDisplay;
use App\Modules\SchoolInstallment\Domain\Enums\SchoolInstallmentFilterStatus;


class SearchSchoolInstallmentDTO
{
    public function __construct(
        public string $Text = "",
        public SchoolInstallmentFilterStatus $Status = SchoolInstallmentFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => SchoolInstallmentFilterStatus::ACTIVE,
            'INACTIVE' => SchoolInstallmentFilterStatus::INACTIVE,
            default => SchoolInstallmentFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}