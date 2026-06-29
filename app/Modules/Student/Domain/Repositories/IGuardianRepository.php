<?php

namespace App\Modules\Guardian\Domain\Repositories;

use App\Helpers\Result;
//use App\Domain\Guardian\Entities\Guardian;
use App\Modules\Guardian\Application\DTOs\CreateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\UpdateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\DuplicatedGuardianDTO;
use App\Modules\Guardian\Application\DTOs\SearchGuardianDTO;
use App\Modules\Guardian\Domain\Enums\GuardianFilterVerified;


interface IGuardianRepository
{
    public function getEntity(): string;

    public function exists(int $Id_Guardian) : Result;

    public function duplicated(DuplicatedGuardianDTO $dto) : Result;

    public function create(CreateGuardianDTO $dto) : Result;

    public function update(UpdateGuardianDTO $dto) : Result;

    public function delete(int $Id_Guardian) : Result;

    public function index(int $Id_Guardian) : Result;

    public function list(GuardianFilterVerified $Verified) : Result;

    public function search(SearchGuardianDTO $dto) : Result;
}