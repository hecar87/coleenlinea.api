<?php

namespace App\Domain\TypeReceipt\Repositories;

use App\Helpers\Result;
use App\Domain\TypeReceipt\Entities\TypeReceipt;
use App\Application\TypeReceipt\DTOs\CreateTypeReceiptDTO;
use App\Application\TypeReceipt\DTOs\UpdateTypeReceiptDTO;
use App\Application\TypeReceipt\DTOs\DuplicatedTypeReceiptDTO;
use App\Application\TypeReceipt\DTOs\SearchTypeReceiptDTO;
use App\Domain\TypeReceipt\Enums\TypeReceiptFilterDisplay;

interface ITypeReceiptRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeReceipt) : Result;

    public function duplicated(DuplicatedTypeReceiptDTO $dto) : Result;

    public function create(CreateTypeReceiptDTO $dto) : Result;

    public function update(UpdateTypeReceiptDTO $dto) : Result;

    public function delete(int $Id_TypeReceipt) : Result;

    public function index(int $Id_TypeReceipt) : Result;

    public function list(TypeReceiptFilterDisplay $Display) : Result;

    public function search(SearchTypeReceiptDTO $dto) : Result;
}