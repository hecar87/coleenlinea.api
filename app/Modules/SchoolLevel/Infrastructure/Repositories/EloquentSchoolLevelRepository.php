<?php

namespace App\Modules\SchoolLevel\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\SchoolLevel\Domain\Repositories\ISchoolLevelRepository;
use App\Modules\SchoolLevel\Infrastructure\Persistence\EloquentSchoolLevel as SchoolLevelModel;

use App\Modules\SchoolLevel\Application\DTOs\CreateSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\UpdateSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\DuplicatedSchoolLevelDTO;
use App\Modules\SchoolLevel\Application\DTOs\SearchSchoolLevelDTO;

use App\Modules\SchoolLevel\Domain\Enums\SchoolLevelFilterDisplay;
use App\Modules\SchoolLevel\Domain\Enums\SchoolLevelFilterStatus;
use App\Modules\SchoolLevel\Domain\Enums\SchoolLevelPublic;
use App\Modules\SchoolLevel\Domain\Enums\SchoolLevelStatus;


class EloquentSchoolLevelRepository implements ISchoolLevelRepository
{
	public function getEntity(): string
	{
		return SchoolLevelModel::getEntity();
	}

	public function exists(int $Id_SchoolLevel): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolLevelModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolLevelModel::query();

			$oQuery->where("Id_SchoolLevel", "=", $Id_SchoolLevel);
			$oQuery->where("SchoolLevel_Status", "<>", "0");

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
	public function duplicated(DuplicatedSchoolLevelDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolLevelModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolLevelModel::query();

			$oQuery->where("Id_SchoolLevel", "<>", $dto->Id_SchoolLevel);
			$oQuery->where("SchoolLevel_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_TypeLevel", "=", $dto->Id_TypeLevel);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("SchoolLevel_Code", "=", $dto->SchoolLevel_Code);
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
	public function create(CreateSchoolLevelDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolLevelModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolLevelModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_SchoolLevel"		=> $dto->Id_SchoolLevel,
				"SchoolLevel_Code"		=> trim( mb_strtoupper( $dto->SchoolLevel_Code, "utf-8" ) ),
				"SchoolLevel_Shift"		=> trim( mb_strtoupper( $dto->SchoolLevel_Shift, "utf-8" ) ),
				"SchoolLevel_Public"	=> $dto->SchoolLevel_Public,
				"SchoolLevel_Status"	=> $dto->SchoolLevel_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeLevel"			=> $dto->Id_TypeLevel
			]);

			$oQuery->where("Id_SchoolLevel", "=", "$Id");
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
	public function update(UpdateSchoolLevelDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolLevelModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= SchoolLevelModel::query();

			$oQuery->where("Id_SchoolLevel", "=", $dto->Id_SchoolLevel);
			$oQuery->update([
				"SchoolLevel_Code"		=> trim( mb_strtoupper( $dto->SchoolLevel_Code, "utf-8" ) ),
				"SchoolLevel_Shift"		=> trim( mb_strtoupper( $dto->SchoolLevel_Shift, "utf-8" ) ),
				"SchoolLevel_Public"	=> $dto->SchoolLevel_Public,
				"SchoolLevel_Status"	=> $dto->SchoolLevel_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeLevel"			=> $dto->Id_TypeLevel
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
	public function delete(int $Id_SchoolLevel): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolLevelModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolLevelModel::query();

			$oQuery->where("Id_SchoolLevel", "=", $Id_SchoolLevel);
			$oQuery->update([
				"SchoolLevel_Shift"		=> DB::raw("CONCAT('( DELETED ) ', SchoolLevel_Shift)"),
				"SchoolLevel_Status"	=> 0
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
	public function index(int $Id_SchoolLevel): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolLevelModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolLevelModel::query();

			$oQuery->join("t_type_level", "t_school_level.Id_TypeLevel", "=", "t_type_level.Id_TypeLevel");
			$oQuery->where("Id_SchoolLevel", "=", $Id_SchoolLevel);
			$oQuery->where("SchoolLevel_Status", "<>", "0");

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
	public function list(int $Id_School, SchoolLevelFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolLevelModel::getEntity();
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
				SchoolLevelFilterDisplay::PUBLIC->value  => 2,
				SchoolLevelFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolLevelModel::query();

			$oQuery->join("t_type_level", "t_school_level.Id_TypeLevel", "=", "t_type_level.Id_TypeLevel");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('SchoolLevel_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('SchoolLevel_Status', '=', SchoolLevelStatus::ACTIVE->value);
			$oQuery->orderBy("SchoolLevel_Shift", "ASC");

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
	public function search(int $Id_School, SearchSchoolLevelDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolLevelModel::getEntity();
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
				SchoolLevelFilterDisplay::PUBLIC->value  => 2,
				SchoolLevelFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				SchoolLevelFilterStatus::ACTIVE->value   => 2,
				SchoolLevelFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolLevelModel::query();

			$oQuery->join("t_type_level", "t_school_level.Id_TypeLevel", "=", "t_type_level.Id_TypeLevel");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('SchoolLevel_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('SchoolLevel_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('SchoolLevel_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("SchoolLevel_Code", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolLevel_Shift", 	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("SchoolLevel_Shift", "ASC");
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
