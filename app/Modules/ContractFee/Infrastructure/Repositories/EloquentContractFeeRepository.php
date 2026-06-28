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
			$oQuery->where("Id_Contract", "=", $dto->Id_Contract);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);
			$oQuery->where("Id_TypeFee", "=", $dto->Id_TypeFee);

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
				"Id_ContractFee"				=> $dto->Id_ContractFee,
				"ContractFee_Fee_Amount"		=> $dto->ContractFee_Fee_Amount,
				"ContractFee_Fee_Percentage"	=> $dto->ContractFee_Fee_Percentage,
				"ContractFee_Fee_Payer"			=> $dto->ContractFee_Fee_Payer,
				"ContractFee_Remark"			=> trim( mb_strtoupper( $dto->ContractFee_Remark, "utf-8" ) ),
				"Id_Contract"					=> $dto->Id_Contract,
				"Id_TypeCurrency"				=> $dto->Id_TypeCurrency,
				"Id_TypeFee"					=> $dto->Id_TypeFee
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
				"ContractFee_Fee_Amount"		=> $dto->ContractFee_Fee_Amount,
				"ContractFee_Fee_Percentage"	=> $dto->ContractFee_Fee_Percentage,
				"ContractFee_Fee_Payer"			=> $dto->ContractFee_Fee_Payer,
				"ContractFee_Remark"			=> trim( mb_strtoupper( $dto->ContractFee_Remark, "utf-8" ) ),
				"Id_TypeCurrency"				=> $dto->Id_TypeCurrency,
				"Id_TypeFee"					=> $dto->Id_TypeFee
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
			$oQuery->delete();


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

			$oQuery->join("t_type_currency", "t_contract_fee.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_fee", "t_contract_fee.Id_TypeFee", "=", "t_type_fee.Id_TypeFee");
			$oQuery->where("Id_ContractFee", "=", $Id_ContractFee);

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
	public function list(int $Id_Contract): Result
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


			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$oQuery->join("t_type_currency", "t_contract_fee.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_fee", "t_contract_fee.Id_TypeFee", "=", "t_type_fee.Id_TypeFee");
			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->orderBy("Id_ContractFee", "ASC");

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
	public function search(int $Id_Contract, SearchContractFeeDTO $dto): Result
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


			//
			//	TRANSACTION
			//
			$oQuery	= ContractFeeModel::query();

			$oQuery->join("t_type_currency", "t_contract_fee.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_fee", "t_contract_fee.Id_TypeFee", "=", "t_type_fee.Id_TypeFee");
			$oQuery->where("Id_Contract", "=", $Id_Contract);
			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("TypeFee_Name", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeFee_Abrv", 		"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Id_ContractFee", "ASC");
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
