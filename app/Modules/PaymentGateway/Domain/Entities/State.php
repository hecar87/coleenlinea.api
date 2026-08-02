<?php

namespace App\Modules\State\Domain\Entities;

use App\Modules\State\Domain\Enums\StatePublic;
use App\Modules\State\Domain\Enums\StateStatus;


class State
{
    public function __construct(
        public readonly int $Id_State,
        public readonly string $State_Code,
        public readonly string $State_Name,
        public readonly string $State_Abrv,
        public readonly StatePublic $State_Public,
        public readonly StateStatus $State_Status
    ) {}


    public static function create(
        string $State_Code,
        string $State_Name,
        string $State_Abrv,
        StatePublic $State_Public,
        StateStatus $State_Status = StateStatus::ACTIVE
    ): self {
        return new self(
            Id_State: 0,
            State_Code: mb_strtoupper(trim($State_Code)),
            State_Name: mb_strtoupper(trim($State_Name)),
            State_Abrv: mb_strtoupper(trim($State_Abrv)),
            State_Public: $State_Public,
            State_Status: $State_Status
        );
    }


    public function isDeleted(): bool
    {
        return $this->State_Status === StateStatus::DELETED;
    }


    public function isActive(): bool
    {
        return $this->State_Status === StateStatus::ACTIVE;
    }


    public function isPublic(): bool
    {
        return $this->State_Public === StatePublic::PUBLIC;
    }
}