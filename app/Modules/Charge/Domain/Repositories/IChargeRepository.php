<?php

namespace App\Modules\Charge\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\Charge\Entities\Charge;
use App\Modules\Charge\Application\DTOs\CreateChargeDTO;
use App\Modules\Charge\Application\DTOs\UpdateChargeDTO;
use App\Modules\Charge\Application\DTOs\DuplicatedChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeByGuardianDTO;
use App\Modules\Charge\Application\DTOs\PayChargeDTO;
use App\Modules\Charge\Domain\Enums\ChargeFilterDisplay;


interface IChargeRepository
{
    public function getEntity(): string;

    public function exists(int $Id_Charge) : Result;

    public function duplicated(DuplicatedChargeDTO $dto) : Result;

    public function canPay(int $Id_Charge) : Result;

    public function canNullify(int $Id_Charge) : Result;

    public function create(CreateChargeDTO $dto) : Result;

    public function update(UpdateChargeDTO $dto) : Result;

    public function delete(int $Id_Charge) : Result;

    public function index(int $Id_Charge) : Result;

    public function find(int $Charge_Code) : Result;

    public function listByGuardian(int $Id_Guardian) : Result;

    public function search(SearchChargeDTO $dto) : Result;

    public function searchByGuardian(int $Id_Guardian, SearchChargeByGuardianDTO $dto) : Result;

    public function pay(PayChargeDTO $dto) : Result;

    public function nullify(int $Id_Charge) : Result;
}