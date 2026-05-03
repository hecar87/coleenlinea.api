<?php

namespace App\Modules\TypeGender\Domain\Repositories;

use App\Helpers\Result;
use App\Domain\TypeGender\Entities\TypeGender;
use App\Application\TypeGender\DTOs\CreateTypeGenderDTO;
use App\Application\TypeGender\DTOs\UpdateTypeGenderDTO;
use App\Application\TypeGender\DTOs\DuplicatedTypeGenderDTO;
use App\Application\TypeGender\DTOs\SearchTypeGenderDTO;
use App\Domain\TypeGender\Enums\TypeGenderFilterDisplay;

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