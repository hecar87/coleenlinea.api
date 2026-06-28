<?php
namespace App\Modules\Contract\Application\DTOs;

use Illuminate\Http\Request;

class CreateContractDTO
{
    public function __construct(
        public int $Id_Contract,
        public string $Contract_Title,
		public string $Contract_Date_Start,
		public string $Contract_Date_End,
		public string $Contract_Manager_Name,
		public string $Contract_Manager_LastName,
		public string $Contract_Manager_Position,
		public string $Contract_Manager_Document,
		public int $Id_School,
		public int $Id_TypeDocument
    ) {}

    public static function fromRequest(Request $oRequest) : self
    {
        return new self(
            Id_Contract: (int) $oRequest->input("Id_Contract", ""),
            Contract_Title: $oRequest->input("Contract_Title", ""),
            Contract_Date_Start: $oRequest->input("Contract_Date_Start", ""),
            Contract_Date_End: $oRequest->input("Contract_Date_End", ""),
            Contract_Manager_Name: $oRequest->input("Contract_Manager_Name", ""),
            Contract_Manager_LastName: $oRequest->input("Contract_Manager_LastName", ""),
            Contract_Manager_Position: $oRequest->input("Contract_Manager_Position", ""),
            Contract_Manager_Document: $oRequest->input("Contract_Manager_Document", ""),
            Id_School: (int) $oRequest->input("Id_School", ""),
            Id_TypeDocument: (int) $oRequest->input("Id_TypeDocument", "")
        );
    }
}