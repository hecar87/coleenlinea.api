<?php

namespace App\Domain\State\Repositories;

use App\Helpers\Result;
//use App\Domain\State\Entities\State;
use App\Application\State\DTOs\CreateStateDTO;
use App\Application\State\DTOs\UpdateStateDTO;
use App\Application\State\DTOs\DuplicatedStateDTO;
use App\Application\State\DTOs\SearchStateDTO;
use App\Domain\State\Enums\StateFilterDisplay;

interface IStateRepository
{
    public function getEntity(): string;

    public function exists(int $Id_State) : Result;

    public function duplicated(DuplicatedStateDTO $dto) : Result;

    public function create(CreateStateDTO $dto) : Result;

    public function update(UpdateStateDTO $dto) : Result;

    public function delete(int $Id_State) : Result;

    public function index(int $Id_State) : Result;

    public function list(StateFilterDisplay $Display) : Result;

    public function search(SearchStateDTO $dto) : Result;
}