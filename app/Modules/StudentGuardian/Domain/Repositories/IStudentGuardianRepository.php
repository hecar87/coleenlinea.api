<?php

namespace App\Modules\StudentGuardian\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\StudentGuardian\Entities\StudentGuardian;
use App\Modules\StudentGuardian\Application\DTOs\CreateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\UpdateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\DuplicatedStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianByGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianByStudentDTO;
use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterVerified;


interface IStudentGuardianRepository
{
    public function getEntity(): string;

    public function exists(int $Id_StudentGuardian) : Result;

    public function duplicated(DuplicatedStudentGuardianDTO $dto) : Result;

    public function create(CreateStudentGuardianDTO $dto) : Result;

    public function update(UpdateStudentGuardianDTO $dto) : Result;

    public function delete(int $Id_StudentGuardian) : Result;

    public function index(int $Id_StudentGuardian) : Result;

    public function listByGuardian(int $Id_School, StudentGuardianFilterVerified $Display) : Result;

    public function listByStudent(int $Id_School, StudentGuardianFilterVerified $Display) : Result;

    public function searchByGuardian(int $Id_School, SearchStudentGuardianByGuardianDTO $dto) : Result;

    public function searchByStudent(int $Id_School, SearchStudentGuardianByStudentDTO $dto) : Result;
}