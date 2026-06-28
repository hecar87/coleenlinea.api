<?php

namespace App\Modules\SchoolClass\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\SchoolClass\Entities\SchoolClass;
use App\Modules\SchoolClass\Application\DTOs\CreateSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\UpdateSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\DuplicatedSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\SearchSchoolClassDTO;
use App\Modules\SchoolClass\Domain\Enums\SchoolClassFilterDisplay;


interface ISchoolClassRepository
{
    public function getEntity(): string;

    public function exists(int $Id_SchoolClass) : Result;

    public function duplicated(DuplicatedSchoolClassDTO $dto) : Result;

    public function create(CreateSchoolClassDTO $dto) : Result;

    public function update(UpdateSchoolClassDTO $dto) : Result;

    public function delete(int $Id_SchoolClass) : Result;

    public function index(int $Id_SchoolClass) : Result;

    public function list(int $Id_School, SchoolClassFilterDisplay $Display) : Result;

    public function search(int $Id_School, SearchSchoolClassDTO $dto) : Result;
}