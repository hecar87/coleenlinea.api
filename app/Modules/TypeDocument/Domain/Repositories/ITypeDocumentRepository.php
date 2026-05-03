<?php

namespace App\Modules\TypeDocument\Domain\Repositories;

use App\Helpers\Result;
use App\Domain\TypeDocument\Entities\TypeDocument;
use App\Application\TypeDocument\DTOs\CreateTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\UpdateTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\DuplicatedTypeDocumentDTO;
use App\Application\TypeDocument\DTOs\SearchTypeDocumentDTO;
use App\Domain\TypeDocument\Enums\TypeDocumentFilterDisplay;

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