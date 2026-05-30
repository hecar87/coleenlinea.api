<?php

namespace App\Modules\SchoolAccount\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\SchoolAccount\Entities\SchoolAccount;
use App\Modules\SchoolAccount\Application\DTOs\CreateSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\UpdateSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\DuplicatedSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\SearchSchoolAccountDTO;
use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountFilterDisplay;


interface ISchoolAccountRepository
{
    public function getEntity(): string;

    public function exists(int $Id_SchoolAccount) : Result;

    public function duplicated(DuplicatedSchoolAccountDTO $dto) : Result;

    public function create(CreateSchoolAccountDTO $dto) : Result;

    public function update(UpdateSchoolAccountDTO $dto) : Result;

    public function delete(int $Id_SchoolAccount) : Result;

    public function index(int $Id_SchoolAccount) : Result;

    public function list(SchoolAccountFilterDisplay $Display) : Result;

    public function search(SearchSchoolAccountDTO $dto) : Result;
}