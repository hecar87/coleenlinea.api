<?php

namespace App\Modules\TypeInstallment\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\TypeInstallment\Application\DTOs\CreateTypeInstallmentDTO;
use App\Modules\TypeInstallment\Application\DTOs\UpdateTypeInstallmentDTO;
use App\Modules\TypeInstallment\Application\DTOs\DuplicatedTypeInstallmentDTO;
use App\Modules\TypeInstallment\Application\DTOs\SearchTypeInstallmentDTO;
use App\Modules\TypeInstallment\Domain\Enums\TypeInstallmentFilterDisplay;

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