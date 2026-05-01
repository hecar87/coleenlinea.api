<?php

namespace App\Modules\TypeCurrency\Domain\Repositories;

use App\Helpers\Result;
use App\Domain\TypeCurrency\Entities\TypeCurrency;
use App\Application\TypeCurrency\DTOs\CreateTypeCurrencyDTO;
use App\Application\TypeCurrency\DTOs\UpdateTypeCurrencyDTO;
use App\Application\TypeCurrency\DTOs\DuplicatedTypeCurrencyDTO;
use App\Application\TypeCurrency\DTOs\SearchTypeCurrencyDTO;
use App\Domain\TypeCurrency\Enums\TypeCurrencyFilterDisplay;

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