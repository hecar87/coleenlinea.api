<?php

namespace App\Modules\City\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\City\Entities\City;
use App\Modules\City\Application\DTOs\CreateCityDTO;
use App\Modules\City\Application\DTOs\UpdateCityDTO;
use App\Modules\City\Application\DTOs\DuplicatedCityDTO;
use App\Modules\City\Application\DTOs\SearchCityDTO;
use App\Modules\City\Domain\Enums\CityFilterDisplay;


interface ICityRepository
{
    public function getEntity(): string;

    public function exists(int $Id_City) : Result;

    public function duplicated(DuplicatedCityDTO $dto) : Result;

    public function create(CreateCityDTO $dto) : Result;

    public function update(UpdateCityDTO $dto) : Result;

    public function delete(int $Id_City) : Result;

    public function index(int $Id_City) : Result;

    public function list(int $Id_State, CityFilterDisplay $Display) : Result;

    public function search(int $Id_State, SearchCityDTO $dto) : Result;
}