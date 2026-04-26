<?php

namespace App\Modules\TypeBank\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\TypeBank\Entities\TypeBank;
use App\Modules\TypeBank\Application\DTOs\CreateTypeBankDTO;
use App\Modules\TypeBank\Application\DTOs\UpdateTypeBankDTO;
use App\Modules\TypeBank\Application\DTOs\DuplicatedTypeBankDTO;
use App\Modules\TypeBank\Application\DTOs\SearchTypeBankDTO;
use App\Modules\TypeBank\Domain\Enums\TypeBankFilterDisplay;

interface ITypeBankRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeBank) : Result;

    public function duplicated(DuplicatedTypeBankDTO $dto) : Result;

    public function create(CreateTypeBankDTO $dto) : Result;

    public function update(UpdateTypeBankDTO $dto) : Result;

    public function delete(int $Id_TypeBank) : Result;

    public function index(int $Id_TypeBank) : Result;

    public function list(TypeBankFilterDisplay $Display) : Result;

    public function search(SearchTypeBankDTO $dto) : Result;
}