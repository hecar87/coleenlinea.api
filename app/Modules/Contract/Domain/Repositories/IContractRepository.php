<?php

namespace App\Modules\Contract\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\Contract\Entities\Contract;
use App\Modules\Contract\Application\DTOs\CreateContractDTO;
use App\Modules\Contract\Application\DTOs\UpdateContractDTO;
use App\Modules\Contract\Application\DTOs\DuplicatedContractDTO;
use App\Modules\Contract\Application\DTOs\SearchContractDTO;
use App\Modules\Contract\Domain\Enums\ContractFilterDisplay;


interface IContractRepository
{
    public function getEntity(): string;

    public function exists(int $Id_Contract) : Result;

    public function duplicated(DuplicatedContractDTO $dto) : Result;

    public function create(CreateContractDTO $dto) : Result;

    public function update(UpdateContractDTO $dto) : Result;

    public function delete(int $Id_Contract) : Result;

    public function index(int $Id_Contract) : Result;

    public function list(int $Id_School) : Result;

    public function search(int $Id_School, SearchContractDTO $dto) : Result;
}