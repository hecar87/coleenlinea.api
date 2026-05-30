<?php

namespace App\Modules\SchoolAccount\Domain\Entities;

use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountPublic;
use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountStatus;


class SchoolAccount
{
    public function __construct(
        public readonly int $Id_SchoolAccount,
        public readonly string $SchoolAccount_Code,
        public readonly string $SchoolAccount_Name,
        public readonly string $SchoolAccount_Abrv,
        public readonly SchoolAccountPublic $SchoolAccount_Public,
        public readonly SchoolAccountStatus $SchoolAccount_Status
    ) {}


    public static function create(
        string $SchoolAccount_Code,
        string $SchoolAccount_Name,
        string $SchoolAccount_Abrv,
        SchoolAccountPublic $SchoolAccount_Public,
        SchoolAccountStatus $SchoolAccount_Status = SchoolAccountStatus::ACTIVE
    ): self {
        return new self(
            Id_SchoolAccount: 0,
            SchoolAccount_Code: mb_strtoupper(trim($SchoolAccount_Code)),
            SchoolAccount_Name: mb_strtoupper(trim($SchoolAccount_Name)),
            SchoolAccount_Abrv: mb_strtoupper(trim($SchoolAccount_Abrv)),
            SchoolAccount_Public: $SchoolAccount_Public,
            SchoolAccount_Status: $SchoolAccount_Status
        );
    }


    public function isDeleted(): bool
    {
        return $this->SchoolAccount_Status === SchoolAccountStatus::DELETED;
    }


    public function isActive(): bool
    {
        return $this->SchoolAccount_Status === SchoolAccountStatus::ACTIVE;
    }


    public function isPublic(): bool
    {
        return $this->SchoolAccount_Public === SchoolAccountPublic::PUBLIC;
    }
}