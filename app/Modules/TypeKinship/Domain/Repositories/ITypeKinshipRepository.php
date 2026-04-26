<?php

namespace App\Domain\TypeKinship\Repositories;

use App\Helpers\Result;
use App\Domain\TypeKinship\Entities\TypeKinship;
use App\Application\TypeKinship\DTOs\CreateTypeKinshipDTO;
use App\Application\TypeKinship\DTOs\UpdateTypeKinshipDTO;
use App\Application\TypeKinship\DTOs\DuplicatedTypeKinshipDTO;
use App\Application\TypeKinship\DTOs\SearchTypeKinshipDTO;
use App\Domain\TypeKinship\Enums\TypeKinshipFilterDisplay;

interface ITypeKinshipRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeKinship) : Result;

    public function duplicated(DuplicatedTypeKinshipDTO $dto) : Result;

    public function create(CreateTypeKinshipDTO $dto) : Result;

    public function update(UpdateTypeKinshipDTO $dto) : Result;

    public function delete(int $Id_TypeKinship) : Result;

    public function index(int $Id_TypeKinship) : Result;

    public function list(TypeKinshipFilterDisplay $Display) : Result;

    public function search(SearchTypeKinshipDTO $dto) : Result;
}