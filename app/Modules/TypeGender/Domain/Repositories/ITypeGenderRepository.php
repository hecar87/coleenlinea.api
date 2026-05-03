<?php

namespace App\Modules\TypeGender\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\TypeGender\Application\DTOs\CreateTypeGenderDTO;
use App\Modules\TypeGender\Application\DTOs\UpdateTypeGenderDTO;
use App\Modules\TypeGender\Application\DTOs\DuplicatedTypeGenderDTO;
use App\Modules\TypeGender\Application\DTOs\SearchTypeGenderDTO;
use App\Modules\TypeGender\Domain\Enums\TypeGenderFilterDisplay;

interface ITypeGenderRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeGender) : Result;

    public function duplicated(DuplicatedTypeGenderDTO $dto) : Result;

    public function create(CreateTypeGenderDTO $dto) : Result;

    public function update(UpdateTypeGenderDTO $dto) : Result;

    public function delete(int $Id_TypeGender) : Result;

    public function index(int $Id_TypeGender) : Result;

    public function list(TypeGenderFilterDisplay $Display) : Result;

    public function search(SearchTypeGenderDTO $dto) : Result;
}