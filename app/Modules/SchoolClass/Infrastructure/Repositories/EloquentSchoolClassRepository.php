<?php

namespace App\Modules\SchoolClass\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\SchoolClass\Domain\Repositories\ISchoolClassRepository;
use App\Modules\SchoolClass\Infrastructure\Persistence\EloquentSchoolClass as SchoolClassModel;

use App\Modules\SchoolClass\Application\DTOs\CreateSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\UpdateSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\DuplicatedSchoolClassDTO;
use App\Modules\SchoolClass\Application\DTOs\SearchSchoolClassDTO;

use App\Modules\SchoolClass\Domain\Enums\SchoolClassFilterDisplay;
use App\Modules\SchoolClass\Domain\Enums\SchoolClassFilterStatus;
use App\Modules\SchoolClass\Domain\Enums\SchoolClassPublic;
use App\Modules\SchoolClass\Domain\Enums\SchoolClassStatus;


class EloquentSchoolClassRepository implements ISchoolClassRepository
{
	public function getEntity(): string
	{
		return SchoolClassModel::getEntity();
	}

	public function exists(int $Id_SchoolClass): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolClassModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolClassModel::query();

			$oQuery->where("Id_SchoolClass", "=", $Id_SchoolClass);
			$oQuery->where("SchoolClass_Status", "<>", "0");

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
	public function duplicated(DuplicatedSchoolClassDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolClassModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolClassModel::query();

			$oQuery->where("Id_SchoolClass", "<>", $dto->Id_SchoolClass);
			$oQuery->where("SchoolClass_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_SchoolLevel", "=", $dto->Id_SchoolLevel);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->orWhere("SchoolClass_Name", "=", $dto->SchoolClass_Name);
				$oSubQuery->orWhere("SchoolClass_Section", "=", $dto->SchoolClass_Section);
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
	public function create(CreateSchoolClassDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolClassModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolClassModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_SchoolClass"		=> $dto->Id_SchoolClass,
				"SchoolClass_Name"		=> trim( mb_strtoupper( $dto->SchoolClass_Name, "utf-8" ) ),
				"SchoolClass_Section"	=> trim( mb_strtoupper( $dto->SchoolClass_Section, "utf-8" ) ),
				"SchoolClass_Public"	=> $dto->SchoolClass_Public,
				"SchoolClass_Status"	=> $dto->SchoolClass_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_SchoolLevel"		=> $dto->Id_SchoolLevel
			]);

			$oQuery->where("Id_SchoolClass", "=", "$Id");
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
	public function update(UpdateSchoolClassDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolClassModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= SchoolClassModel::query();

			$oQuery->where("Id_SchoolClass", "=", $dto->Id_SchoolClass);
			$oQuery->update([
				"SchoolClass_Name"		=> trim( mb_strtoupper( $dto->SchoolClass_Name, "utf-8" ) ),
				"SchoolClass_Section"	=> trim( mb_strtoupper( $dto->SchoolClass_Section, "utf-8" ) ),
				"SchoolClass_Public"	=> $dto->SchoolClass_Public,
				"SchoolClass_Status"	=> $dto->SchoolClass_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_SchoolLevel"		=> $dto->Id_SchoolLevel
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
	public function delete(int $Id_SchoolClass): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolClassModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolClassModel::query();

			$oQuery->where("Id_SchoolClass", "=", $Id_SchoolClass);
			$oQuery->update([
				"SchoolClass_Name"		=> DB::raw("CONCAT('( DELETED ) ', SchoolClass_Name)"),
				"SchoolClass_Status"	=> 0
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
	public function index(int $Id_SchoolClass): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolClassModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolClassModel::query();

			$oQuery->join("t_school_level", "t_school_class.Id_TypeLevel", "=", "t_school_level.Id_TypeLevel");
			$oQuery->where("Id_SchoolClass", "=", $Id_SchoolClass);
			$oQuery->where("SchoolClass_Status", "<>", "0");

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
	public function list(int $Id_School, SchoolClassFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolClassModel::getEntity();
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
				SchoolClassFilterDisplay::PUBLIC->value  => 2,
				SchoolClassFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolClassModel::query();

			$oQuery->join("t_school_level", "t_school_class.Id_TypeLevel", "=", "t_school_level.Id_TypeLevel");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('SchoolClass_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('SchoolClass_Status', '=', SchoolClassStatus::ACTIVE->value);
			$oQuery->orderBy("SchoolClass_Name", "ASC");

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
	public function search(int $Id_School, SearchSchoolClassDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolClassModel::getEntity();
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
				SchoolClassFilterDisplay::PUBLIC->value  => 2,
				SchoolClassFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				SchoolClassFilterStatus::ACTIVE->value   => 2,
				SchoolClassFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolClassModel::query();

			$oQuery->join("t_school_level", "t_school_class.Id_TypeLevel", "=", "t_school_level.Id_TypeLevel");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('SchoolClass_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('SchoolClass_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('SchoolClass_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->orWhere	("SchoolClass_Name",	"LIKE", "%".$dto->Text."%");
				$oSubQuery->where	("SchoolClass_Section",	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("SchoolClass_Name", "ASC");
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
