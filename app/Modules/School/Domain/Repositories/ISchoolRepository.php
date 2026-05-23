<?php

namespace App\Modules\School\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\School\Entities\School;
use App\Modules\School\Application\DTOs\CreateSchoolDTO;
use App\Modules\School\Application\DTOs\UpdateSchoolDTO;
use App\Modules\School\Application\DTOs\DuplicatedSchoolDTO;
use App\Modules\School\Application\DTOs\SearchSchoolDTO;
use App\Modules\School\Domain\Enums\SchoolFilterDisplay;


interface ISchoolRepository
{
    public function getEntity(): string;

    public function exists(int $Id_School) : Result;

    public function duplicated(DuplicatedSchoolDTO $dto) : Result;

    public function create(CreateSchoolDTO $dto) : Result;

    public function update(UpdateSchoolDTO $dto) : Result;

    public function delete(int $Id_School) : Result;

    public function index(int $Id_School) : Result;

    public function list(SchoolFilterDisplay $Display) : Result;

    public function search(SearchSchoolDTO $dto) : Result;
}