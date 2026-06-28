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
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_TypeBank", "=", $dto->Id_TypeBank);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Contract_Number", "=", $dto->Contract_Number);
				$oSubQuery->orWhere("Contract_CCI", "=", $dto->Contract_CCI);
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

			$Id 	= $oQuery->insertGetId([
				"Id_Contract"		=> $dto->Id_Contract,
				"Contract_Number"	=> trim( mb_strtoupper( $dto->Contract_Number, "utf-8" ) ),
				"Contract_CCI"		=> trim( mb_strtoupper( $dto->Contract_CCI, "utf-8" ) ),
				"Contract_Remark"	=> trim( mb_strtoupper( $dto->Contract_Remark, "utf-8" ) ),
				"Contract_Default"	=> 1,
				"Contract_Public"	=> $dto->Contract_Public,
				"Contract_Status"	=> $dto->Contract_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
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
				"Contract_Number"	=> trim( mb_strtoupper( $dto->Contract_Number, "utf-8" ) ),
				"Contract_CCI"		=> trim( mb_strtoupper( $dto->Contract_CCI, "utf-8" ) ),
				"Contract_Remark"	=> trim( mb_strtoupper( $dto->Contract_Remark, "utf-8" ) ),
				"Contract_Default"	=> 1,
				"Contract_Public"	=> $dto->Contract_Public,
				"Contract_Status"	=> $dto->Contract_Status,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
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
				"Contract_Number"	=> DB::raw("CONCAT('( DELETED ) ', Contract_Number)"),
				"Contract_CCI"		=> DB::raw("CONCAT('( DELETED ) ', Contract_CCI)"),
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

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
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
	public function list(int $Id_School, ContractFilterDisplay $Display): Result
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
			$whereDisplay	= [
				ContractFilterDisplay::PUBLIC->value  => 2,
				ContractFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('Contract_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('Contract_Status', '=', ContractStatus::ACTIVE->value);
			$oQuery->orderBy("Contract_Default", "DESC");
			$oQuery->orderBy("Id_Contract", "DESC");

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

			$whereDisplay	= [
				ContractFilterDisplay::PUBLIC->value  => 2,
				ContractFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				ContractFilterStatus::ACTIVE->value   => 2,
				ContractFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ContractModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('Contract_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Contract_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Contract_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("Contract_Number", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Contract_CCI", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Contract_Remark", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Name", 			"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Contract_Default", "DESC");
			$oQuery->orderBy("Id_Contract", "DESC");
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
}
