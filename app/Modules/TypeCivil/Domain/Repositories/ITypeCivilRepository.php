<?php

namespace App\Domain\TypeCivil\Repositories;

use App\Helpers\Result;
use App\Domain\TypeCivil\Entities\TypeCivil;
use App\Application\TypeCivil\DTOs\CreateTypeCivilDTO;
use App\Application\TypeCivil\DTOs\UpdateTypeCivilDTO;
use App\Application\TypeCivil\DTOs\DuplicatedTypeCivilDTO;
use App\Application\TypeCivil\DTOs\SearchTypeCivilDTO;
use App\Domain\TypeCivil\Enums\TypeCivilFilterDisplay;

interface ITypeCivilRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeCivil) : Result;

    public function duplicated(DuplicatedTypeCivilDTO $dto) : Result;

    public function create(CreateTypeCivilDTO $dto) : Result;

    public function update(UpdateTypeCivilDTO $dto) : Result;

    public function delete(int $Id_TypeCivil) : Result;

    public function index(int $Id_TypeCivil) : Result;

    public function list(TypeCivilFilterDisplay $Display) : Result;

    public function search(SearchTypeCivilDTO $dto) : Result;
}