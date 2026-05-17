<?php

namespace App\Modules\TypeReceipt\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\TypeReceipt\Application\DTOs\CreateTypeReceiptDTO;
use App\Modules\TypeReceipt\Application\DTOs\UpdateTypeReceiptDTO;
use App\Modules\TypeReceipt\Application\DTOs\DuplicatedTypeReceiptDTO;
use App\Modules\TypeReceipt\Application\DTOs\SearchTypeReceiptDTO;
use App\modules\TypeReceipt\Domain\Enums\TypeReceiptFilterDisplay;

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