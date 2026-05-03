<?php

namespace App\Modules\TypeFee\Domain\Repositories;

use App\Helpers\Result;
use App\Domain\TypeFee\Entities\TypeFee;
use App\Application\TypeFee\DTOs\CreateTypeFeeDTO;
use App\Application\TypeFee\DTOs\UpdateTypeFeeDTO;
use App\Application\TypeFee\DTOs\DuplicatedTypeFeeDTO;
use App\Application\TypeFee\DTOs\SearchTypeFeeDTO;
use App\Domain\TypeFee\Enums\TypeFeeFilterDisplay;

interface ITypeFeeRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeFee) : Result;

    public function duplicated(DuplicatedTypeFeeDTO $dto) : Result;

    public function create(CreateTypeFeeDTO $dto) : Result;

    public function update(UpdateTypeFeeDTO $dto) : Result;

    public function delete(int $Id_TypeFee) : Result;

    public function index(int $Id_TypeFee) : Result;

    public function list(TypeFeeFilterDisplay $Display) : Result;

    public function search(SearchTypeFeeDTO $dto) : Result;
}