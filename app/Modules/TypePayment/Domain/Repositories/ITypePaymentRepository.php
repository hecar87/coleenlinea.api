<?php

namespace App\Domain\TypePayment\Repositories;

use App\Helpers\Result;
use App\Domain\TypePayment\Entities\TypePayment;
use App\Application\TypePayment\DTOs\CreateTypePaymentDTO;
use App\Application\TypePayment\DTOs\UpdateTypePaymentDTO;
use App\Application\TypePayment\DTOs\DuplicatedTypePaymentDTO;
use App\Application\TypePayment\DTOs\SearchTypePaymentDTO;
use App\Domain\TypePayment\Enums\TypePaymentFilterDisplay;

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