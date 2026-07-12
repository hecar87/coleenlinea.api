<?php

namespace App\Modules\EnrollmentInstallment\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\EnrollmentInstallment\Entities\EnrollmentInstallment;
use App\Modules\EnrollmentInstallment\Application\DTOs\CreateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\UpdateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\DuplicatedEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\SearchEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Domain\Enums\EnrollmentInstallmentFilterPaid;


interface IEnrollmentInstallmentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_EnrollmentInstallment) : Result;

    public function duplicated(DuplicatedEnrollmentInstallmentDTO $dto) : Result;

    public function create(CreateEnrollmentInstallmentDTO $dto) : Result;

    public function update(UpdateEnrollmentInstallmentDTO $dto) : Result;

    public function delete(int $Id_EnrollmentInstallment) : Result;

    public function index(int $Id_EnrollmentInstallment) : Result;

    public function list(int $Id_School, EnrollmentInstallmentFilterPaid $Paid) : Result;

    public function search(int $Id_School, SearchEnrollmentInstallmentDTO $dto) : Result;
}