<?php

namespace App\Modules\TypePayment\Domain\Repositories;

use App\Helpers\Result;

use App\Modules\TypePayment\Application\DTOs\CreateTypePaymentDTO;
use App\Modules\TypePayment\Application\DTOs\UpdateTypePaymentDTO;
use App\Modules\TypePayment\Application\DTOs\DuplicatedTypePaymentDTO;
use App\Modules\TypePayment\Application\DTOs\SearchTypePaymentDTO;
use App\Modules\TypePayment\Domain\Enums\TypePaymentFilterDisplay;

interface ITypePaymentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypePayment) : Result;

    public function duplicated(DuplicatedTypePaymentDTO $dto) : Result;

    public function create(CreateTypePaymentDTO $dto) : Result;

    public function update(UpdateTypePaymentDTO $dto) : Result;

    public function delete(int $Id_TypePayment) : Result;

    public function index(int $Id_TypePayment) : Result;

    public function list(TypePaymentFilterDisplay $Display) : Result;

    public function search(SearchTypePaymentDTO $dto) : Result;
}