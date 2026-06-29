<?php

namespace App\Modules\Enrollment\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\Enrollment\Entities\Enrollment;
use App\Modules\Enrollment\Application\DTOs\CreateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\UpdateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\DuplicatedEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentDTO;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterDisplay;


interface IEnrollmentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_Enrollment) : Result;

    public function duplicated(DuplicatedEnrollmentDTO $dto) : Result;

    public function create(CreateEnrollmentDTO $dto) : Result;

    public function update(UpdateEnrollmentDTO $dto) : Result;

    public function delete(int $Id_Enrollment) : Result;

    public function index(int $Id_Enrollment) : Result;

    public function list(int $Id_School, EnrollmentFilterDisplay $Display) : Result;

    public function search(int $Id_School, SearchEnrollmentDTO $dto) : Result;
}