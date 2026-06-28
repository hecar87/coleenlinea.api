<?php

namespace App\Modules\Contract\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Contract\Domain\Repositories\IContractRepository;
use App\Modules\Contract\Infrastructure\Persistence\EloquentContract as ContractModel;

use App\Modules\Contract\Application\DTOs\CreateContractDTO;
use App\Modules\Contract\Application\DTOs\UpdateContractDTO;
use App\Modules\Contract\Application\DTOs\DuplicatedContractDTO;
use App\Modules\Contract\Application\DTOs\SearchContractDTO;

use App\Modules\Contract\Domain\Enums\ContractFilterDisplay;
use App\Modules\Contract\Domain\Enums\ContractFilterStatus;
use App\Modules\Contract\Domain\Enums\ContractPublic;
use App\Modules\Contract\Domain\Enums\ContractStatus;


class EloquentContractRepository implements IContractRepository
{
	public function getEntity(): string
	{
		return ContractModel::getEntity();
	}

	public function exists(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->where("Contract_Status", "<>", "0");

			$exists = $oQuery->count();


			//
			//	FUNCTION
			//
			if ($exists == 1) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2200, $oEntity);
			}
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function duplicated(DuplicatedContractDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "<>", $dto->Id_Contract);
			$oQuery->where("Contract_Status", "<>", "0");
			$oQuery->where("Contract_Status", "<>", "9");
			$oQuery->where("Id_School", "=", $dto->Id_School);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->whereBetween("Contract_Date_Start", [$dto->Contract_Date_Start, $dto->Contract_Date_End]);
				$oSubQuery->orWhereBetween("Contract_Date_End", [$dto->Contract_Date_Start, $dto->Contract_Date_End]);
			});

			$Duplicate	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($Duplicate == 0) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2201, $oEntity);
			}
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function validate(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= [];
		$Validate	= false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->where("Contract_Date_Start", "<=", now());
			$oQuery->where("Contract_Date_End", ">=", now());
			$oQuery->where("Contract_Status", "=", "2");

			$Validate	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($Validate == true) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2201, $oEntity);
			}
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function canUpdate(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= [];
		$Validate	= false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->where("Contract_Status", "=", "1");

			$oData	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2201, $oEntity);
			}
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function canApprove(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= [];
		$Validate	= false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->where("Contract_Status", "=", "1");

			$oData	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2201, $oEntity);
			}
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function canNullify(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= [];
		$Validate	= false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->where("Contract_Status", "=", "2");

			$oData	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2201, $oEntity);
			}
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function canClose(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= [];
		$Validate	= false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->where("Contract_Status", "=", "2");

			$oData	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2201, $oEntity);
			}
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function create(CreateContractDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$Contract_Code = $this->generateCode($dto->Id_School);

			$Id 	= $oQuery->insertGetId([
				"Id_Contract"					=> $dto->Id_Contract,
				"Contract_Date_Created"			=> date("Y-m-d H:i:s"),
				"Contract_Date_Approved"		=> date("Y-m-d H:i:s"),
				"Contract_Date_Nullified" 		=> date("Y-m-d H:i:s"),
				"Contract_Date_Closed" 			=> date("Y-m-d H:i:s"),
				"Contract_Code"					=> $Contract_Code,
				"Contract_Title"				=> trim( mb_strtoupper( $dto->Contract_Title, "utf-8" ) ),
				"Contract_Date_Start"			=> $dto->Contract_Date_Start,
				"Contract_Date_End"				=> $dto->Contract_Date_End,
				"Contract_Manager_Name"			=> trim( mb_strtoupper( $dto->Contract_Manager_Name, "utf-8" ) ),
				"Contract_Manager_LastName"		=> trim( mb_strtoupper( $dto->Contract_Manager_LastName, "utf-8" ) ),
				"Contract_Manager_Position"		=> trim( mb_strtoupper( $dto->Contract_Manager_Position, "utf-8" ) ),
				"Contract_Manager_Document"		=> trim( mb_strtoupper( $dto->Contract_Manager_Document, "utf-8" ) ),
				"Contract_Status"				=> 1,
				"Id_School"						=> $dto->Id_School,
				"Id_TypeDocument"				=> $dto->Id_TypeDocument
			]);

			$oQuery->where("Id_Contract", "=", "$Id");
			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1001, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function update(UpdateContractDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $dto->Id_Contract);
			$oQuery->update([
				"Contract_Title"				=> trim( mb_strtoupper( $dto->Contract_Title, "utf-8" ) ),
				"Contract_Date_Start"			=> $dto->Contract_Date_Start,
				"Contract_Date_End"				=> $dto->Contract_Date_End,
				"Contract_Manager_Name"			=> trim( mb_strtoupper( $dto->Contract_Manager_Name, "utf-8" ) ),
				"Contract_Manager_LastName"		=> trim( mb_strtoupper( $dto->Contract_Manager_LastName, "utf-8" ) ),
				"Contract_Manager_Position"		=> trim( mb_strtoupper( $dto->Contract_Manager_Position, "utf-8" ) ),
				"Contract_Manager_Document"		=> trim( mb_strtoupper( $dto->Contract_Manager_Document, "utf-8" ) ),
				"Id_TypeDocument"				=> $dto->Id_TypeDocument
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1002, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function delete(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->update([
				"Contract_Title"	=> DB::raw("CONCAT('( DELETED ) ', Contract_Title)"),
				"Contract_Status"	=> 0
			]);


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1003, $oEntity);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function index(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->join("t_type_document", "t_contract.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->where("Contract_Status", "<>", "0");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1004, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function list(int $Id_School): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	SET VARIABLES
			//


			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->join("t_type_document", "t_contract.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->where("Id_School", "=", $Id_School);
			$oQuery->where('Contract_Status', '=', ContractStatus::ACTIVE->value);
			$oQuery->orderBy("Contract_Date_Created", "DESC");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1005, $oEntity, $oData);
		}
		catch (\Exception $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function search(int $Id_School, SearchContractDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	SET VARIABLES
			//
			$Page_Current	= $dto->Page_Current;
			$Page_Size		= PaginationManager::Pagination_Size($dto->Page_Size);
			$Page_Offset	= PaginationManager::Pagination_Offset($Page_Size, $Page_Current);

			$whereStatus	= [
				ContractFilterStatus::ACTIVE->value   => 2,
				ContractFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->join("t_type_document", "t_contract.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Contract_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Contract_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("Contract_Code", 				"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Contract_Title", 				"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Contract_Manager_Name", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Contract_Manager_LastName", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Contract_Manager_Document", 	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Contract_Date_Created", "DESC");
			$oQuery->limit($Page_Size);
			$oQuery->offset($Page_Offset);

			// GET DATA
			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1006, $oEntity, $oData, $Data_Total);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function approve(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->update([
				"Contract_Date_Approved"	=> now(),
				"Contract_Status"			=> 2,
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1000, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function nullify(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->update([
				"Contract_Date_Nullified"	=> now(),
				"Contract_Status"			=> 9,
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1000, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function close(int $Id_Contract): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ContractModel::query();

			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->update([
				"Contract_Date_Closed"	=> now(),
				"Contract_Status"		=> 6,
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1000, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}


	private function generateCode(int $Id_School): string
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractModel::getEntity();
		$oResult	= "";


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oRow				= ContractModel::where("Id_School", "=", $Id_School)->orderBy("Id_Contract", "DESC")->get()->first();
			$New_Id				= $oRow == null ? 1 : $oRow->Id_Contract + 1;

			$Code_Contract		= str_pad( $New_Id, 6, "0", STR_PAD_LEFT );
			$Code_School		= str_pad( $Id_School, 2, "0", STR_PAD_LEFT );
			$Code_Year			= date("Ym");

			$oResult			= $Code_Year.$Code_School.$Code_Contract;
		} catch (\Exception $oException) {
			$oResult = "ERCODE";
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}
