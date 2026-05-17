<?php

namespace App\Modules\TypePopulation\Application\DTOs;

use Illuminate\Http\Request;

class UpdateTypePopulationDTO
{
    public function __construct(
        public int $Id_TypePopulation,
        public string $TypePopulation_Name,
        public string $TypePopulation_Abrv,
        public int $TypePopulation_Public,
        public int $TypePopulation_Status
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypePopulation: (int) $oRequest->input('Id_TypePopulation'),
            TypePopulation_Name: $oRequest->input('TypePopulation_Name', ''),
            TypePopulation_Abrv: $oRequest->input('TypePopulation_Abrv', ''),
            TypePopulation_Public: (int) $oRequest->input('TypePopulation_Public', 2),
            TypePopulation_Status: (int) $oRequest->input('TypePopulation_Status', 2)
        );
    }
}