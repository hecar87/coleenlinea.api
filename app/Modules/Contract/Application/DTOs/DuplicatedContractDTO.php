<?php
namespace App\Modules\Contract\Application\DTOs;

use Illuminate\Http\Request;

class DuplicatedContractDTO
{
    public function __construct(
        public int $Id_Contract,
		public string $Contract_Date_Start,
		public string $Contract_Date_End,
		public int $Id_School
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Contract: (int) $oRequest->input("Id_Contract", ""),
            Contract_Date_Start: $oRequest->input("Contract_Date_Start", ""),
            Contract_Date_End: $oRequest->input("Contract_Date_End", ""),
            Id_School: (int) $oRequest->input("Id_School", "")
        );
    }
}