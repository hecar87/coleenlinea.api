<?php

namespace App\Domain\District\Repositories;

use App\Helpers\Result;
//use App\Domain\District\Entities\District;
use App\Application\District\DTOs\CreateDistrictDTO;
use App\Application\District\DTOs\UpdateDistrictDTO;
use App\Application\District\DTOs\DuplicatedDistrictDTO;
use App\Application\District\DTOs\SearchDistrictDTO;
use App\Domain\District\Enums\DistrictFilterDisplay;

interface IDistrictRepository
{
    public function getEntity(): string;

    public function exists(int $Id_District) : Result;

    public function duplicated(DuplicatedDistrictDTO $dto) : Result;

    public function create(CreateDistrictDTO $dto) : Result;

    public function update(UpdateDistrictDTO $dto) : Result;

    public function delete(int $Id_District) : Result;

    public function index(int $Id_District) : Result;

    public function list(int $Id_City, DistrictFilterDisplay $Display) : Result;

    public function search(int $Id_City, SearchDistrictDTO $dto) : Result;
}