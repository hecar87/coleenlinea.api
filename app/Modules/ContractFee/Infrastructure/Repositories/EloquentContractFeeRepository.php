<?php

namespace App\Modules\ContractFee\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\ContractFee\Domain\Repositories\IContractFeeRepository;
use App\Modules\ContractFee\Infrastructure\Persistence\EloquentContractFee as ContractFeeModel;

use App\Modules\ContractFee\Application\DTOs\CreateContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\UpdateContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\DuplicatedContractFeeDTO;
use App\Modules\ContractFee\Application\DTOs\SearchContractFeeDTO;

use App\Modules\ContractFee\Domain\Enums\ContractFeeFilterDisplay;
use App\Modules\ContractFee\Domain\Enums\ContractFeeFilterStatus;
use App\Modules\ContractFee\Domain\Enums\ContractFeePublic;
use App\Modules\ContractFee\Domain\Enums\ContractFeeStatus;


class EloquentContractFeeRepository implements IContractFeeRepository
{
	public function getEntity(): string
	{
		return ContractFeeModel::getEntity();
	}

	public function exists(int $Id_ContractFee): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractFeeModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$oQuery->where("Id_ContractFee", "=", $Id_ContractFee);
			$oQuery->where("ContractFee_Status", "<>", "0");

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
	public function duplicated(DuplicatedContractFeeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractFeeModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$oQuery->where("Id_ContractFee", "<>", $dto->Id_ContractFee);
			$oQuery->where("ContractFee_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_TypeBank", "=", $dto->Id_TypeBank);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("ContractFee_Number", "=", $dto->ContractFee_Number);
				$oSubQuery->orWhere("ContractFee_CCI", "=", $dto->ContractFee_CCI);
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
	public function create(CreateContractFeeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractFeeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_ContractFee"		=> $dto->Id_ContractFee,
				"ContractFee_Number"	=> trim( mb_strtoupper( $dto->ContractFee_Number, "utf-8" ) ),
				"ContractFee_CCI"		=> trim( mb_strtoupper( $dto->ContractFee_CCI, "utf-8" ) ),
				"ContractFee_Remark"	=> trim( mb_strtoupper( $dto->ContractFee_Remark, "utf-8" ) ),
				"ContractFee_Default"	=> 1,
				"ContractFee_Public"	=> $dto->ContractFee_Public,
				"ContractFee_Status"	=> $dto->ContractFee_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
			]);

			$oQuery->where("Id_ContractFee", "=", "$Id");
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
	public function update(UpdateContractFeeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractFeeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ContractFeeModel::query();

			$oQuery->where("Id_ContractFee", "=", $dto->Id_ContractFee);
			$oQuery->update([
				"ContractFee_Number"	=> trim( mb_strtoupper( $dto->ContractFee_Number, "utf-8" ) ),
				"ContractFee_CCI"		=> trim( mb_strtoupper( $dto->ContractFee_CCI, "utf-8" ) ),
				"ContractFee_Remark"	=> trim( mb_strtoupper( $dto->ContractFee_Remark, "utf-8" ) ),
				"ContractFee_Default"	=> 1,
				"ContractFee_Public"	=> $dto->ContractFee_Public,
				"ContractFee_Status"	=> $dto->ContractFee_Status,
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
	public function delete(int $Id_ContractFee): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractFeeModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$oQuery->where("Id_ContractFee", "=", $Id_ContractFee);
			$oQuery->update([
				"ContractFee_Number"	=> DB::raw("CONCAT('( DELETED ) ', ContractFee_Number)"),
				"ContractFee_CCI"		=> DB::raw("CONCAT('( DELETED ) ', ContractFee_CCI)"),
				"ContractFee_Status"	=> 0
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
	public function index(int $Id_ContractFee): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractFeeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_ContractFee", "=", $Id_ContractFee);
			$oQuery->where("ContractFee_Status", "<>", "0");

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
	public function list(int $Id_School, ContractFeeFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractFeeModel::getEntity();
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
				ContractFeeFilterDisplay::PUBLIC->value  => 2,
				ContractFeeFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('ContractFee_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('ContractFee_Status', '=', ContractFeeStatus::ACTIVE->value);
			$oQuery->orderBy("ContractFee_Default", "DESC");
			$oQuery->orderBy("Id_ContractFee", "DESC");

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
	public function search(int $Id_School, SearchContractFeeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ContractFeeModel::getEntity();
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
				ContractFeeFilterDisplay::PUBLIC->value  => 2,
				ContractFeeFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				ContractFeeFilterStatus::ACTIVE->value   => 2,
				ContractFeeFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('ContractFee_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('ContractFee_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('ContractFee_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("ContractFee_Number", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("ContractFee_CCI", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("ContractFee_Remark", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Name", 			"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("ContractFee_Default", "DESC");
			$oQuery->orderBy("Id_ContractFee", "DESC");
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
