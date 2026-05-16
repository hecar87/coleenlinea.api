<?php

namespace App\Modules\TypeKinship\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\TypeKinship\Application\DTOs\CreateTypeKinshipDTO;
use App\Modules\TypeKinship\Application\DTOs\UpdateTypeKinshipDTO;
use App\Modules\TypeKinship\Application\DTOs\DuplicatedTypeKinshipDTO;
use App\Modules\TypeKinship\Application\DTOs\SearchTypeKinshipDTO;
use App\Modules\TypeKinship\Domain\Enums\TypeKinshipFilterDisplay;

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