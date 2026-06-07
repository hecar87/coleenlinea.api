<?php

namespace App\Modules\SchoolLevel\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\SchoolLevel\Entities\SchoolLevel;
use App\Modules\SchoolLevel\Application\DTOs\CreateSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\UpdateSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\DuplicatedSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\SearchSchoolLevelDTO;
use App\Modules\SchoolLevel\Domain\Enums\SchoolLevelFilterDisplay;


interface ISchoolLevelRepository
{
    public function getEntity(): string;

    public function exists(int $Id_SchoolLevel) : Result;

    public function duplicated(DuplicatedSchoolLevelDTO $dto) : Result;

    public function create(CreateSchoolLevelDTO $dto) : Result;

    public function update(UpdateSchoolLevelDTO $dto) : Result;

    public function delete(int $Id_SchoolLevel) : Result;

    public function index(int $Id_SchoolLevel) : Result;

    public function list(int $Id_School, SchoolLevelFilterDisplay $Display) : Result;

    public function search(int $Id_School, SearchSchoolLevelDTO $dto) : Result;
}