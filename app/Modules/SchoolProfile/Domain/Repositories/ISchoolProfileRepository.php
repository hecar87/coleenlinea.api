<?php

namespace App\Modules\SchoolProfile\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\SchoolProfile\Entities\SchoolProfile;
use App\Modules\SchoolProfile\Application\DTOs\CreateSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\UpdateSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\DuplicatedSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\SearchSchoolProfileDTO;


interface ISchoolProfileRepository
{
    public function getEntity(): string;

    public function exists(int $Id_SchoolProfile) : Result;

    public function duplicated(DuplicatedSchoolProfileDTO $dto) : Result;

    public function create(CreateSchoolProfileDTO $dto) : Result;

    public function update(UpdateSchoolProfileDTO $dto) : Result;

    public function delete(int $Id_SchoolProfile) : Result;

    public function index(int $Id_SchoolProfile) : Result;

    public function list(int $Id_School) : Result;

    public function search(int $Id_School, SearchSchoolProfileDTO $dto) : Result;
}