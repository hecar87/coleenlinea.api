<?php
namespace App\Application\City\DTOs;

use Illuminate\Http\Request;
use App\Domain\City\Enums\CityFilterDisplay;
use App\Domain\City\Enums\CityFilterStatus;

class SearchCityDTO
{
    public function __construct(
        public int $Id_State = 0,
        public string $Text = "",
        public CityFilterDisplay $Display = CityFilterDisplay::ALL,
        public CityFilterStatus $Status = CityFilterStatus::ALL,
        public int $Page_Size = 10,
        public int $Page_Current = 1
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        $display = match (strtoupper($oRequest->input('Display', 'ALL'))) {
            'PUBLIC' => CityFilterDisplay::PUBLIC,
            'PRIVATE' => CityFilterDisplay::PRIVATE,
            default => CityFilterDisplay::ALL,
        };

        $status = match (strtoupper($oRequest->input('Status', 'ALL'))) {
            'ACTIVE' => CityFilterStatus::ACTIVE,
            'INACTIVE' => CityFilterStatus::INACTIVE,
            default => CityFilterStatus::ALL,
        };

        return new self(
            Id_State: (int) $oRequest->input('Id_State', 0),
            Text: (string) $oRequest->input('Text', ''),
            Display: $display,
            Status: $status,
            Page_Size: (int) $oRequest->input('Page_Size', 10),
            Page_Current: (int) $oRequest->input('Page_Current', 1)
        );
    }
}