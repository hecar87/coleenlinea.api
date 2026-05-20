<?php

namespace App\Modules\TypeSchool\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\TypeSchool\Application\DTOs\CreateTypeSchoolDTO;
use App\Modules\TypeSchool\Application\DTOs\UpdateTypeSchoolDTO;
use App\Modules\TypeSchool\Application\DTOs\DuplicatedTypeSchoolDTO;
use App\Modules\TypeSchool\Application\DTOs\SearchTypeSchoolDTO;
use App\Modules\TypeSchool\Domain\Enums\TypeSchoolFilterDisplay;

interface ITypeSchoolRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeSchool) : Result;

    public function duplicated(DuplicatedTypeSchoolDTO $dto) : Result;

    public function create(CreateTypeSchoolDTO $dto) : Result;

    public function update(UpdateTypeSchoolDTO $dto) : Result;

    public function delete(int $Id_TypeSchool) : Result;

    public function index(int $Id_TypeSchool) : Result;

    public function list(TypeSchoolFilterDisplay $Display) : Result;

    public function search(SearchTypeSchoolDTO $dto) : Result;
}