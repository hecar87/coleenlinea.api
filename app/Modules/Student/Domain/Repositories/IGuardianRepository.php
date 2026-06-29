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

    public function canVerify(int $Id_Guardian) : Result;

    public function canActivate(int $Id_Guardian) : Result;

    public function canDeactivate(int $Id_Guardian) : Result;

    public function create(CreateGuardianDTO $dto) : Result;

    public function update(UpdateGuardianDTO $dto) : Result;

    public function delete(int $Id_Guardian) : Result;

    public function index(int $Id_Guardian) : Result;

    public function list(GuardianFilterVerified $Verified) : Result;

    public function search(SearchGuardianDTO $dto) : Result;

    public function verify(int $Id_Guardian) : Result;

    public function activate(int $Id_Guardian) : Result;

    public function deactivate(int $Id_Guardian) : Result;
}