<?php

namespace App\Domain\TypeLevel\Repositories;

use App\Helpers\Result;
use App\Domain\TypeLevel\Entities\TypeLevel;
use App\Application\TypeLevel\DTOs\CreateTypeLevelDTO;
use App\Application\TypeLevel\DTOs\UpdateTypeLevelDTO;
use App\Application\TypeLevel\DTOs\DuplicatedTypeLevelDTO;
use App\Application\TypeLevel\DTOs\SearchTypeLevelDTO;
use App\Domain\TypeLevel\Enums\TypeLevelFilterDisplay;

interface ITypeLevelRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeLevel) : Result;

    public function duplicated(DuplicatedTypeLevelDTO $dto) : Result;

    public function create(CreateTypeLevelDTO $dto) : Result;

    public function update(UpdateTypeLevelDTO $dto) : Result;

    public function delete(int $Id_TypeLevel) : Result;

    public function index(int $Id_TypeLevel) : Result;

    public function list(TypeLevelFilterDisplay $Display) : Result;

    public function search(SearchTypeLevelDTO $dto) : Result;
}