<?php

namespace App\Domain\City\Repositories;

use App\Helpers\Result;
//use App\Domain\City\Entities\City;
use App\Application\City\DTOs\CreateCityDTO;
use App\Application\City\DTOs\UpdateCityDTO;
use App\Application\City\DTOs\DuplicatedCityDTO;
use App\Application\City\DTOs\SearchCityDTO;
use App\Domain\City\Enums\CityFilterDisplay;

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