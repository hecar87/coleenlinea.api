<?php

namespace App\Domain\TypeSchool\Repositories;

use App\Helpers\Result;
use App\Domain\TypeSchool\Entities\TypeSchool;
use App\Application\TypeSchool\DTOs\CreateTypeSchoolDTO;
use App\Application\TypeSchool\DTOs\UpdateTypeSchoolDTO;
use App\Application\TypeSchool\DTOs\DuplicatedTypeSchoolDTO;
use App\Application\TypeSchool\DTOs\SearchTypeSchoolDTO;
use App\Domain\TypeSchool\Enums\TypeSchoolFilterDisplay;

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