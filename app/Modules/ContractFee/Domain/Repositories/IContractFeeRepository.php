<?php

namespace App\Modules\ContractFee\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\ContractFee\Entities\ContractFee;
use App\Modules\ContractFee\Application\DTOs\CreateContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\UpdateContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\DuplicatedContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\SearchContractFeeDTO;
use App\Modules\ContractFee\Domain\Enums\ContractFeeFilterDisplay;


interface IContractFeeRepository
{
    public function getEntity(): string;

    public function exists(int $Id_ContractFee) : Result;

    public function duplicated(DuplicatedContractFeeDTO $dto) : Result;

    public function create(CreateContractFeeDTO $dto) : Result;

    public function update(UpdateContractFeeDTO $dto) : Result;

    public function delete(int $Id_ContractFee) : Result;

    public function index(int $Id_ContractFee) : Result;

    public function list(int $Id_Contract) : Result;

    public function search(int $Id_Contract, SearchContractFeeDTO $dto) : Result;
}