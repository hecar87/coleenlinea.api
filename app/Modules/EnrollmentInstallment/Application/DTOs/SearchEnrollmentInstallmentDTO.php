<?php
namespace App\Modules\EnrollmentInstallment\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\EnrollmentInstallment\Domain\Enums\EnrollmentInstallmentFilterPaid;
use App\Modules\EnrollmentInstallment\Domain\Enums\EnrollmentInstallmentFilterStatus;


class SearchEnrollmentInstallmentDTO
{
    public function __construct(
        public string $Text = "",
        public EnrollmentInstallmentFilterPaid $Paid = EnrollmentInstallmentFilterPaid::ALL,
        public EnrollmentInstallmentFilterStatus $Status = EnrollmentInstallmentFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $paid = match (strtoupper($oRequest->input('Paid', 'ALL'))) {
            'PAID' => EnrollmentInstallmentFilterPaid::PAID,
            'PENDING' => EnrollmentInstallmentFilterPaid::PENDING,
            default => EnrollmentInstallmentFilterPaid::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => EnrollmentInstallmentFilterStatus::ACTIVE,
            'INACTIVE' => EnrollmentInstallmentFilterStatus::INACTIVE,
            default => EnrollmentInstallmentFilterStatus::ALL,
        };

        return new self(
            Text: (string) $oRequest->input('Text', ''),
            Paid: $paid,
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}