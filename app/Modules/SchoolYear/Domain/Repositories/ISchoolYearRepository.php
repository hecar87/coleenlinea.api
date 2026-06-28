<?php

namespace App\Modules\SchoolYear\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\SchoolYear\Entities\SchoolYear;
use App\Modules\SchoolYear\Application\DTOs\CreateSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\UpdateSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\DuplicatedSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\SearchSchoolYearDTO;
use App\Modules\SchoolYear\Domain\Enums\SchoolYearFilterDisplay;


interface ISchoolYearRepository
{
    public function getEntity(): string;

    public function exists(int $Id_SchoolYear) : Result;

    public function duplicated(DuplicatedSchoolYearDTO $dto) : Result;

    public function create(CreateSchoolYearDTO $dto) : Result;

    public function update(UpdateSchoolYearDTO $dto) : Result;

    public function delete(int $Id_SchoolYear) : Result;

    public function index(int $Id_SchoolYear) : Result;

    public function list(int $Id_School, SchoolYearFilterDisplay $Display) : Result;

    public function search(int $Id_School, SearchSchoolYearDTO $dto) : Result;
}