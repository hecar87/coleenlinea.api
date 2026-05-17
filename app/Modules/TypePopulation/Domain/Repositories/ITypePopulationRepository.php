<?php

namespace App\Modules\TypePopulation\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\TypePopulation\Application\DTOs\CreateTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\UpdateTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\DuplicatedTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\SearchTypePopulationDTO;
use App\Modules\TypePopulation\Domain\Enums\TypePopulationFilterDisplay;

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