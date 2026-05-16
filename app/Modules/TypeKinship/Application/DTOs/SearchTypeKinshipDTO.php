<?php

namespace App\Modules\TypeKinship\Application\DTOs;

use Illuminate\Http\Request;
use App\Modules\TypeKinship\Domain\Enums\TypeKinshipFilterDisplay;
use App\Modules\TypeKinship\Domain\Enums\TypeKinshipFilterStatus;

class SearchTypeKinshipDTO
{
    public function __construct(
        public string $Text = "",
        public TypeKinshipFilterDisplay $Display = TypeKinshipFilterDisplay::ALL,
        public TypeKinshipFilterStatus $Status = TypeKinshipFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypeKinshipFilterDisplay::PUBLIC,
            'PRIVATE' => TypeKinshipFilterDisplay::PRIVATE,
            default => TypeKinshipFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypeKinshipFilterStatus::ACTIVE,
            'INACTIVE' => TypeKinshipFilterStatus::INACTIVE,
            default => TypeKinshipFilterStatus::ALL,
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