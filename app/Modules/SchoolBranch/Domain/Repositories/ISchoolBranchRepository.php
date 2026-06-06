<?php

namespace App\Modules\SchoolBranch\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\SchoolBranch\Entities\SchoolBranch;
use App\Modules\SchoolBranch\Application\DTOs\CreateSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\UpdateSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\DuplicatedSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\SearchSchoolBranchDTO;
use App\Modules\SchoolBranch\Domain\Enums\SchoolBranchFilterDisplay;


interface ISchoolBranchRepository
{
    public function getEntity(): string;

    public function exists(int $Id_SchoolBranch) : Result;

    public function duplicated(DuplicatedSchoolBranchDTO $dto) : Result;

    public function create(CreateSchoolBranchDTO $dto) : Result;

    public function update(UpdateSchoolBranchDTO $dto) : Result;

    public function delete(int $Id_SchoolBranch) : Result;

    public function index(int $Id_SchoolBranch) : Result;

    public function list(int $Id_School, SchoolBranchFilterDisplay $Display) : Result;

    public function search(int $Id_School, SearchSchoolBranchDTO $dto) : Result;
}