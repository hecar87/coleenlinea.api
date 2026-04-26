<?php

namespace App\Modules\District\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\District\Domain\Enums\DistrictFilterDisplay;
use App\Modules\District\Domain\Enums\DistrictFilterStatus;

class SearchDistrictDTO
{
    public function __construct(
        public int $Id_City = 0,
        public string $Text = "",
        public DistrictFilterDisplay $Display = DistrictFilterDisplay::ALL,
        public DistrictFilterStatus $Status = DistrictFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => DistrictFilterDisplay::PUBLIC,
            'PRIVATE' => DistrictFilterDisplay::PRIVATE,
            default => DistrictFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => DistrictFilterStatus::ACTIVE,
            'INACTIVE' => DistrictFilterStatus::INACTIVE,
            default => DistrictFilterStatus::ALL,
        };

        return new self(
            Id_City: (int) $oRequest->input('Id_City', 0),
            Text: (string) $oRequest->input('Text', ''),
            Display: $display,
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}