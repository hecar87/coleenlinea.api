<?php

namespace App\Modules\Student\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\Student\Entities\Student;
use App\Modules\Student\Application\DTOs\CreateStudentDTO;
use App\Modules\Student\Application\DTOs\UpdateStudentDTO;
use App\Modules\Student\Application\DTOs\DuplicatedStudentDTO;
use App\Modules\Student\Application\DTOs\SearchStudentDTO;
use App\Modules\Student\Domain\Enums\StudentFilterDisplay;


interface IStudentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_Student) : Result;

    public function duplicated(DuplicatedStudentDTO $dto) : Result;

    public function create(CreateStudentDTO $dto) : Result;

    public function update(UpdateStudentDTO $dto) : Result;

    public function delete(int $Id_Student) : Result;

    public function index(int $Id_Student) : Result;

    public function list(StudentFilterDisplay $Display) : Result;

    public function search(SearchStudentDTO $dto) : Result;
}