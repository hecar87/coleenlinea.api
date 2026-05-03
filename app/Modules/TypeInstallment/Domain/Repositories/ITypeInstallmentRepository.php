<?php

namespace App\Modules\TypeInstallment\Domain\Repositories;

use App\Helpers\Result;
use App\Domain\TypeInstallment\Entities\TypeInstallment;
use App\Application\TypeInstallment\DTOs\CreateTypeInstallmentDTO;
use App\Application\TypeInstallment\DTOs\UpdateTypeInstallmentDTO;
use App\Application\TypeInstallment\DTOs\DuplicatedTypeInstallmentDTO;
use App\Application\TypeInstallment\DTOs\SearchTypeInstallmentDTO;
use App\Domain\TypeInstallment\Enums\TypeInstallmentFilterDisplay;

interface ITypeInstallmentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeInstallment) : Result;

    public function duplicated(DuplicatedTypeInstallmentDTO $dto) : Result;

    public function create(CreateTypeInstallmentDTO $dto) : Result;

    public function update(UpdateTypeInstallmentDTO $dto) : Result;

    public function delete(int $Id_TypeInstallment) : Result;

    public function index(int $Id_TypeInstallment) : Result;

    public function list(TypeInstallmentFilterDisplay $Display) : Result;

    public function search(SearchTypeInstallmentDTO $dto) : Result;
}