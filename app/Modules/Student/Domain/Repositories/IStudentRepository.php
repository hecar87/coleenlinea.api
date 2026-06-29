<?php

namespace App\Modules\Student\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\Student\Entities\Student;
use App\Modules\Student\Application\DTOs\CreateStudentDTO;
use App\Modules\Student\Application\DTOs\UpdateStudentDTO;
use App\Modules\Student\Application\DTOs\DuplicatedStudentDTO;
use App\Modules\Student\Application\DTOs\SearchStudentDTO;
use App\Modules\Student\Domain\Enums\StudentFilterVerified;


interface IStudentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_Student) : Result;

    public function duplicated(DuplicatedStudentDTO $dto) : Result;

    public function canVerify(int $Id_Student) : Result;

    public function canActivate(int $Id_Student) : Result;

    public function canDeactivate(int $Id_Student) : Result;

    public function create(CreateStudentDTO $dto) : Result;

    public function update(UpdateStudentDTO $dto) : Result;

    public function delete(int $Id_Student) : Result;

    public function index(int $Id_Student) : Result;

    public function list(StudentFilterVerified $Verified) : Result;

    public function search(SearchStudentDTO $dto) : Result;

    public function verify(int $Id_Student) : Result;

    public function activate(int $Id_Student) : Result;

    public function deactivate(int $Id_Student) : Result;
}