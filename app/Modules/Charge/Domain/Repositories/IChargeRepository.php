<?php

namespace App\Modules\Charge\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\Charge\Entities\Charge;
use App\Modules\Charge\Application\DTOs\CreateChargeDTO;
use App\Modules\Charge\Application\DTOs\UpdateChargeDTO;
use App\Modules\Charge\Application\DTOs\DuplicatedChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeDTO;
use App\Modules\Charge\Domain\Enums\ChargeFilterDisplay;


interface IChargeRepository
{
    public function getEntity(): string;

    public function exists(int $Id_Charge) : Result;

    public function duplicated(DuplicatedChargeDTO $dto) : Result;

    public function create(CreateChargeDTO $dto) : Result;

    public function update(UpdateChargeDTO $dto) : Result;

    public function delete(int $Id_Charge) : Result;

    public function index(int $Id_Charge) : Result;

    public function list(ChargeFilterDisplay $Display) : Result;

    public function search(SearchChargeDTO $dto) : Result;
}