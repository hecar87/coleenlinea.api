<?php

namespace App\Modules\SchoolProfile\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;
use App\Modules\SchoolProfile\Infrastructure\Persistence\EloquentSchoolProfile as SchoolProfileModel;

use App\Modules\SchoolProfile\Application\DTOs\CreateSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\UpdateSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\DuplicatedSchoolProfileDTO;
use App\Modules\SchoolProfile\Application\DTOs\SearchSchoolProfileDTO;

use App\Modules\SchoolProfile\Domain\Enums\SchoolProfileFilterDisplay;
use App\Modules\SchoolProfile\Domain\Enums\SchoolProfileFilterStatus;
use App\Modules\SchoolProfile\Domain\Enums\SchoolProfilePublic;
use App\Modules\SchoolProfile\Domain\Enums\SchoolProfileStatus;


class EloquentSchoolProfileRepository implements ISchoolProfileRepository
{
	public function getEntity(): string
	{
		return SchoolProfileModel::getEntity();
	}

	public function exists(int $Id_SchoolProfile): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolProfileModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$oQuery->where("Id_SchoolProfile", "=", $Id_SchoolProfile);
			$oQuery->where("SchoolProfile_Status", "<>", "0");

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
	public function duplicated(DuplicatedSchoolProfileDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolProfileModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$oQuery->where("Id_SchoolProfile", "<>", $dto->Id_SchoolProfile);
			$oQuery->where("SchoolProfile_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_TypeBank", "=", $dto->Id_TypeBank);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("SchoolProfile_Number", "=", $dto->SchoolProfile_Number);
				$oSubQuery->orWhere("SchoolProfile_CCI", "=", $dto->SchoolProfile_CCI);
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
	public function create(CreateSchoolProfileDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolProfileModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_SchoolProfile"		=> $dto->Id_SchoolProfile,
				"SchoolProfile_Number"	=> trim( mb_strtoupper( $dto->SchoolProfile_Number, "utf-8" ) ),
				"SchoolProfile_CCI"		=> trim( mb_strtoupper( $dto->SchoolProfile_CCI, "utf-8" ) ),
				"SchoolProfile_Remark"	=> trim( mb_strtoupper( $dto->SchoolProfile_Remark, "utf-8" ) ),
				"SchoolProfile_Default"	=> 1,
				"SchoolProfile_Public"	=> $dto->SchoolProfile_Public,
				"SchoolProfile_Status"	=> $dto->SchoolProfile_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
			]);

			$oQuery->where("Id_SchoolProfile", "=", "$Id");
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
	public function update(UpdateSchoolProfileDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolProfileModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= SchoolProfileModel::query();

			$oQuery->where("Id_SchoolProfile", "=", $dto->Id_SchoolProfile);
			$oQuery->update([
				"SchoolProfile_Number"	=> trim( mb_strtoupper( $dto->SchoolProfile_Number, "utf-8" ) ),
				"SchoolProfile_CCI"		=> trim( mb_strtoupper( $dto->SchoolProfile_CCI, "utf-8" ) ),
				"SchoolProfile_Remark"	=> trim( mb_strtoupper( $dto->SchoolProfile_Remark, "utf-8" ) ),
				"SchoolProfile_Default"	=> 1,
				"SchoolProfile_Public"	=> $dto->SchoolProfile_Public,
				"SchoolProfile_Status"	=> $dto->SchoolProfile_Status,
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
	public function delete(int $Id_SchoolProfile): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolProfileModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$oQuery->where("Id_SchoolProfile", "=", $Id_SchoolProfile);
			$oQuery->update([
				"SchoolProfile_Number"	=> DB::raw("CONCAT('( DELETED ) ', SchoolProfile_Number)"),
				"SchoolProfile_CCI"		=> DB::raw("CONCAT('( DELETED ) ', SchoolProfile_CCI)"),
				"SchoolProfile_Status"	=> 0
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
	public function index(int $Id_SchoolProfile): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolProfileModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_SchoolProfile", "=", $Id_SchoolProfile);
			$oQuery->where("SchoolProfile_Status", "<>", "0");

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
	public function list(int $Id_School, SchoolProfileFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolProfileModel::getEntity();
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
				SchoolProfileFilterDisplay::PUBLIC->value  => 2,
				SchoolProfileFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('SchoolProfile_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('SchoolProfile_Status', '=', SchoolProfileStatus::ACTIVE->value);
			$oQuery->orderBy("SchoolProfile_Default", "DESC");
			$oQuery->orderBy("Id_SchoolProfile", "DESC");

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
	public function search(int $Id_School, SearchSchoolProfileDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolProfileModel::getEntity();
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
				SchoolProfileFilterDisplay::PUBLIC->value  => 2,
				SchoolProfileFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				SchoolProfileFilterStatus::ACTIVE->value   => 2,
				SchoolProfileFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('SchoolProfile_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('SchoolProfile_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('SchoolProfile_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("SchoolProfile_Number", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolProfile_CCI", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolProfile_Remark", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Name", 			"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("SchoolProfile_Default", "DESC");
			$oQuery->orderBy("Id_SchoolProfile", "DESC");
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
