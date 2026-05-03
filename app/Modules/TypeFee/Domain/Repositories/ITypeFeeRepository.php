<?php

namespace App\Modules\TypeFee\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\TypeFee\Application\DTOs\CreateTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\UpdateTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\DuplicatedTypeFeeDTO;
use App\Modules\TypeFee\Application\DTOs\SearchTypeFeeDTO;
use App\Modules\TypeFee\Domain\Enums\TypeFeeFilterDisplay;

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