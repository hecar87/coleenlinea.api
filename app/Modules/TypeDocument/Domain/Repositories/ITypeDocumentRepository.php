<?php

namespace App\Modules\TypeDocument\Domain\Repositories;

use App\Helpers\Result;
use App\Modules\TypeDocument\Application\DTOs\CreateTypeDocumentDTO;
use App\Modules\TypeDocument\Application\DTOs\UpdateTypeDocumentDTO;
use App\Modules\TypeDocument\Application\DTOs\DuplicatedTypeDocumentDTO;
use App\Modules\TypeDocument\Application\DTOs\SearchTypeDocumentDTO;
use App\Modules\TypeDocument\Domain\Enums\TypeDocumentFilterDisplay;


interface ITypeDocumentRepository
{
    public function getEntity(): string;

    public function exists(int $Id_TypeDocument) : Result;

    public function duplicated(DuplicatedTypeDocumentDTO $dto) : Result;

    public function create(CreateTypeDocumentDTO $dto) : Result;

    public function update(UpdateTypeDocumentDTO $dto) : Result;

    public function delete(int $Id_TypeDocument) : Result;

    public function index(int $Id_TypeDocument) : Result;

    public function list(TypeDocumentFilterDisplay $Display) : Result;

    public function search(SearchTypeDocumentDTO $dto) : Result;
}