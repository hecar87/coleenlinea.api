<?php

namespace App\Modules\TypeCurrency\Domain\Repositories;

use App\Helpers\Result;
use App\Domain\TypeCurrency\Entities\TypeCurrency;
use App\Modules\TypeCurrency\Application\DTOs\CreateTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\UpdateTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\DuplicatedTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\SearchTypeCurrencyDTO;
use App\Modules\TypeCurrency\Domain\Enums\TypeCurrencyFilterDisplay;


interface ITypeCurrencyRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeCurrency) : Result;

    public function duplicated(DuplicatedTypeCurrencyDTO $dto) : Result;

    public function create(CreateTypeCurrencyDTO $dto) : Result;

    public function update(UpdateTypeCurrencyDTO $dto) : Result;

    public function delete(int $Id_TypeCurrency) : Result;

    public function index(int $Id_TypeCurrency) : Result;

    public function list(TypeCurrencyFilterDisplay $Display) : Result;

    public function search(SearchTypeCurrencyDTO $dto) : Result;
}