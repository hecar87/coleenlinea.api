<?php

namespace App\Domain\TypePopulation\Repositories;

use App\Helpers\Result;
use App\Domain\TypePopulation\Entities\TypePopulation;
use App\Application\TypePopulation\DTOs\CreateTypePopulationDTO;
use App\Application\TypePopulation\DTOs\UpdateTypePopulationDTO;
use App\Application\TypePopulation\DTOs\DuplicatedTypePopulationDTO;
use App\Application\TypePopulation\DTOs\SearchTypePopulationDTO;
use App\Domain\TypePopulation\Enums\TypePopulationFilterDisplay;

interface ITypePopulationRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypePopulation) : Result;

    public function duplicated(DuplicatedTypePopulationDTO $dto) : Result;

    public function create(CreateTypePopulationDTO $dto) : Result;

    public function update(UpdateTypePopulationDTO $dto) : Result;

    public function delete(int $Id_TypePopulation) : Result;

    public function index(int $Id_TypePopulation) : Result;

    public function list(TypePopulationFilterDisplay $Display) : Result;

    public function search(SearchTypePopulationDTO $dto) : Result;
}