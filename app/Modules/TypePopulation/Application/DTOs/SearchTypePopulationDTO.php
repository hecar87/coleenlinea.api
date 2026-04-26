<?php
namespace App\Application\TypePopulation\DTOs;

use Illuminate\Http\Request;
use App\Domain\TypePopulation\Enums\TypePopulationFilterDisplay;
use App\Domain\TypePopulation\Enums\TypePopulationFilterStatus;

class SearchTypePopulationDTO
{
    public function __construct(
        public string $Text = "",
        public TypePopulationFilterDisplay $Display = TypePopulationFilterDisplay::ALL,
        public TypePopulationFilterStatus $Status = TypePopulationFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => TypePopulationFilterDisplay::PUBLIC,
            'PRIVATE' => TypePopulationFilterDisplay::PRIVATE,
            default => TypePopulationFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => TypePopulationFilterStatus::ACTIVE,
            'INACTIVE' => TypePopulationFilterStatus::INACTIVE,
            default => TypePopulationFilterStatus::ALL,
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