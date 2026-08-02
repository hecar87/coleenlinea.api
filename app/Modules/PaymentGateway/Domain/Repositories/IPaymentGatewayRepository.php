<?php

namespace App\Modules\State\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\State\Entities\State;
use App\Modules\State\Application\DTOs\CreateStateDTO;
use App\Modules\State\Application\DTOs\UpdateStateDTO;
use App\Modules\State\Application\DTOs\DuplicatedStateDTO;
use App\Modules\State\Application\DTOs\SearchStateDTO;
use App\Modules\State\Domain\Enums\StateFilterDisplay;


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