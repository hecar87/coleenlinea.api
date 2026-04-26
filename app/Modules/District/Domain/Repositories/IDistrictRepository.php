<?php

namespace App\Modules\District\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\District\Entities\District;
use App\Modules\District\Application\DTOs\CreateDistrictDTO;
use App\Modules\District\Application\DTOs\UpdateDistrictDTO;
use App\Modules\District\Application\DTOs\DuplicatedDistrictDTO;
use App\Modules\District\Application\DTOs\SearchDistrictDTO;
use App\Modules\District\Domain\Enums\DistrictFilterDisplay;

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