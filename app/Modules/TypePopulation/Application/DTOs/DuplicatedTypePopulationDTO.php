<?php
namespace App\Application\TypePopulation\DTOs;

use Illuminate\Http\Request;

class DuplicatedTypePopulationDTO
{
    public function __construct(
        public int $Id_TypePopulation,
        public string $TypePopulation_Name,
        public string $TypePopulation_Abrv
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_TypePopulation: (int) $oRequest->input('Id_TypePopulation', 0),
            TypePopulation_Name: $oRequest->input('TypePopulation_Name', ''),
            TypePopulation_Abrv: $oRequest->input('TypePopulation_Abrv', '')
        );
    }
}