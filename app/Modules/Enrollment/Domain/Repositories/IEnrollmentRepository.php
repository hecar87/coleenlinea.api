<?php

namespace App\Modules\Enrollment\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\Enrollment\Entities\Enrollment;
use App\Modules\Enrollment\Application\DTOs\CreateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\UpdateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\DuplicatedEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentBySchoolClassDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentBySchoolYearDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentByStudentDTO;


interface IEnrollmentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_Enrollment) : Result;

    public function duplicated(DuplicatedEnrollmentDTO $dto) : Result;

    public function canUpdate(int $Id_Enrollment) : Result;

    public function canEnroll(int $Id_Enrollment) : Result;

    public function canNullify(int $Id_Enrollment) : Result;

    public function create(CreateEnrollmentDTO $dto, string $Date_Start, string $Date_End) : Result;

    public function update(UpdateEnrollmentDTO $dto) : Result;

    public function delete(int $Id_Enrollment) : Result;

    public function index(int $Id_Enrollment) : Result;

    public function listBySchoolClass(int $Id_SchoolClass) : Result;

    public function listByStudent(int $Id_Student) : Result;

    public function searchBySchoolClass(int $Id_SchoolClass, SearchEnrollmentBySchoolClassDTO $dto) : Result;

    public function searchBySchoolYear(int $Id_SchoolYear, SearchEnrollmentBySchoolYearDTO $dto) : Result;

    public function searchByStudent(int $Id_Student, SearchEnrollmentByStudentDTO $dto) : Result;

    public function enroll(int $Id_Enrollment) : Result;

    public function nullify(int $Id_Enrollment) : Result;

}