<?php

namespace App\Modules\SchoolInstallment\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\SchoolInstallment\Entities\SchoolInstallment;
use App\Modules\SchoolInstallment\Application\DTOs\CreateSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\UpdateSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\DuplicatedSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\SearchSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Domain\Enums\SchoolInstallmentFilterDisplay;


interface ISchoolInstallmentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_SchoolInstallment) : Result;

    public function duplicated(DuplicatedSchoolInstallmentDTO $dto) : Result;

    public function create(CreateSchoolInstallmentDTO $dto) : Result;

    public function update(UpdateSchoolInstallmentDTO $dto) : Result;

    public function delete(int $Id_SchoolInstallment) : Result;

    public function index(int $Id_SchoolInstallment) : Result;

    public function list(int $Id_SchoolYear, SchoolInstallmentFilterDisplay $Display) : Result;

    public function search(int $Id_SchoolYear, SearchSchoolInstallmentDTO $dto) : Result;
}