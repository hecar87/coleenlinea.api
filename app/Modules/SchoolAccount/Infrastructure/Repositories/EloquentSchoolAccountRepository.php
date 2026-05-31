<?php

namespace App\Modules\SchoolAccount\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\SchoolAccount\Domain\Repositories\ISchoolAccountRepository;
use App\Modules\SchoolAccount\Infrastructure\Persistence\EloquentSchoolAccount as SchoolAccountModel;

use App\Modules\SchoolAccount\Application\DTOs\CreateSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\UpdateSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\DuplicatedSchoolAccountDTO;
use App\Modules\SchoolAccount\Application\DTOs\SearchSchoolAccountDTO;

use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountFilterDisplay;
use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountFilterStatus;
use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountPublic;
use App\Modules\SchoolAccount\Domain\Enums\SchoolAccountStatus;


class EloquentSchoolAccountRepository implements ISchoolAccountRepository
{
	public function getEntity(): string
	{
		return SchoolAccountModel::getEntity();
	}

	public function exists(int $Id_SchoolAccount): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolAccountModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolAccountModel::query();

			$oQuery->where("Id_SchoolAccount", "=", $Id_SchoolAccount);
			$oQuery->where("SchoolAccount_Status", "<>", "0");

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
	public function duplicated(DuplicatedSchoolAccountDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolAccountModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolAccountModel::query();

			$oQuery->where("Id_SchoolAccount", "<>", $dto->Id_SchoolAccount);
			$oQuery->where("SchoolAccount_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_TypeBank", "=", $dto->Id_TypeBank);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("SchoolAccount_Number", "=", $dto->SchoolAccount_Number);
				$oSubQuery->orWhere("SchoolAccount_CCI", "=", $dto->SchoolAccount_CCI);
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
	public function create(CreateSchoolAccountDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolAccountModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolAccountModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_SchoolAccount"		=> $dto->Id_SchoolAccount,
				"SchoolAccount_Number"	=> trim( mb_strtoupper( $dto->SchoolAccount_Number, "utf-8" ) ),
				"SchoolAccount_CCI"		=> trim( mb_strtoupper( $dto->SchoolAccount_CCI, "utf-8" ) ),
				"SchoolAccount_Remark"	=> trim( mb_strtoupper( $dto->SchoolAccount_Remark, "utf-8" ) ),
				"SchoolAccount_Default"	=> 1,
				"SchoolAccount_Public"	=> $dto->SchoolAccount_Public,
				"SchoolAccount_Status"	=> $dto->SchoolAccount_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
			]);

			$oQuery->where("Id_SchoolAccount", "=", "$Id");
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
	public function update(UpdateSchoolAccountDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolAccountModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= SchoolAccountModel::query();

			$oQuery->where("Id_SchoolAccount", "=", $dto->Id_SchoolAccount);
			$oQuery->update([
				"SchoolAccount_Number"	=> trim( mb_strtoupper( $dto->SchoolAccount_Number, "utf-8" ) ),
				"SchoolAccount_CCI"		=> trim( mb_strtoupper( $dto->SchoolAccount_CCI, "utf-8" ) ),
				"SchoolAccount_Remark"	=> trim( mb_strtoupper( $dto->SchoolAccount_Remark, "utf-8" ) ),
				"SchoolAccount_Default"	=> 1,
				"SchoolAccount_Public"	=> $dto->SchoolAccount_Public,
				"SchoolAccount_Status"	=> $dto->SchoolAccount_Status,
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
	public function delete(int $Id_SchoolAccount): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolAccountModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolAccountModel::query();

			$oQuery->where("Id_SchoolAccount", "=", $Id_SchoolAccount);
			$oQuery->update([
				"SchoolAccount_Number"	=> DB::raw("CONCAT('( DELETED ) ', SchoolAccount_Number)"),
				"SchoolAccount_CCI"		=> DB::raw("CONCAT('( DELETED ) ', SchoolAccount_CCI)"),
				"SchoolAccount_Status"	=> 0
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
	public function index(int $Id_SchoolAccount): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolAccountModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolAccountModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_SchoolAccount", "=", $Id_SchoolAccount);
			$oQuery->where("SchoolAccount_Status", "<>", "0");

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
	public function list(int $Id_School, SchoolAccountFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolAccountModel::getEntity();
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
				SchoolAccountFilterDisplay::PUBLIC->value  => 2,
				SchoolAccountFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolAccountModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('SchoolAccount_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('SchoolAccount_Status', '=', SchoolAccountStatus::ACTIVE->value);
			$oQuery->orderBy("SchoolAccount_Default", "DESC");
			$oQuery->orderBy("Id_SchoolAccount", "DESC");

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
	public function search(int $Id_School, SearchSchoolAccountDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolAccountModel::getEntity();
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
				SchoolAccountFilterDisplay::PUBLIC->value  => 2,
				SchoolAccountFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				SchoolAccountFilterStatus::ACTIVE->value   => 2,
				SchoolAccountFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolAccountModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('SchoolAccount_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('SchoolAccount_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('SchoolAccount_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("SchoolAccount_Number", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolAccount_CCI", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolAccount_Remark", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Name", 			"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("SchoolAccount_Default", "DESC");
			$oQuery->orderBy("Id_SchoolAccount", "DESC");
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
