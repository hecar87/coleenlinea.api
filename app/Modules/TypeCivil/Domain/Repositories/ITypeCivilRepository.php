<?php

namespace App\Modules\TypeCivil\Domain\Repositories;

use App\Helpers\Result;

use App\Modules\TypeCivil\Application\DTOs\CreateTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\UpdateTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\DuplicatedTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\SearchTypeCivilDTO;
use App\Modules\TypeCivil\Domain\Enums\TypeCivilFilterDisplay;


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