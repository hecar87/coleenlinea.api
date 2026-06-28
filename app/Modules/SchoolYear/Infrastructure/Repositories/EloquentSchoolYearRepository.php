<?php

namespace App\Modules\SchoolYear\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;
use App\Modules\SchoolYear\Infrastructure\Persistence\EloquentSchoolYear as SchoolYearModel;

use App\Modules\SchoolYear\Application\DTOs\CreateSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\UpdateSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\DuplicatedSchoolYearDTO;
use App\Modules\SchoolYear\Application\DTOs\SearchSchoolYearDTO;

use App\Modules\SchoolYear\Domain\Enums\SchoolYearFilterDisplay;
use App\Modules\SchoolYear\Domain\Enums\SchoolYearFilterStatus;
use App\Modules\SchoolYear\Domain\Enums\SchoolYearPublic;
use App\Modules\SchoolYear\Domain\Enums\SchoolYearStatus;


class EloquentSchoolYearRepository implements ISchoolYearRepository
{
	public function getEntity(): string
	{
		return SchoolYearModel::getEntity();
	}

	public function exists(int $Id_SchoolYear): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolYearModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolYearModel::query();

			$oQuery->where("Id_SchoolYear", "=", $Id_SchoolYear);
			$oQuery->where("SchoolYear_Status", "<>", "0");

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
	public function duplicated(DuplicatedSchoolYearDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolYearModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolYearModel::query();

			$oQuery->where("Id_SchoolYear", "<>", $dto->Id_SchoolYear);
			$oQuery->where("SchoolYear_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("SchoolYear_Name", "=", $dto->SchoolYear_Name);
				$oSubQuery->orWhere("SchoolYear_Year", "=", $dto->SchoolYear_Year);
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
	public function create(CreateSchoolYearDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolYearModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolYearModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_SchoolYear"				=> $dto->Id_SchoolYear,
				"SchoolYear_Name"			=> trim( mb_strtoupper( $dto->SchoolYear_Name, "utf-8" ) ),
				"SchoolYear_Year"			=> $dto->SchoolYear_Year,
				"SchoolYear_Date_Start"		=> $dto->SchoolYear_Date_Start,
				"SchoolYear_Date_End"		=> $dto->SchoolYear_Date_End,
				"SchoolYear_Status"			=> $dto->SchoolYear_Status,
				"Id_School"					=> $dto->Id_School
			]);

			$oQuery->where("Id_SchoolYear", "=", "$Id");
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
	public function update(UpdateSchoolYearDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolYearModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= SchoolYearModel::query();

			$oQuery->where("Id_SchoolYear", "=", $dto->Id_SchoolYear);
			$oQuery->update([
				"SchoolYear_Name"			=> trim( mb_strtoupper( $dto->SchoolYear_Name, "utf-8" ) ),
				"SchoolYear_Year"			=> $dto->SchoolYear_Year,
				"SchoolYear_Date_Start"		=> $dto->SchoolYear_Date_Start,
				"SchoolYear_Date_End"		=> $dto->SchoolYear_Date_End,
				"SchoolYear_Status"			=> $dto->SchoolYear_Status,
				"Id_School"					=> $dto->Id_School
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
	public function delete(int $Id_SchoolYear): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolYearModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolYearModel::query();

			$oQuery->where("Id_SchoolYear", "=", $Id_SchoolYear);
			$oQuery->update([
				"SchoolYear_Name"		=> DB::raw("CONCAT('( DELETED ) ', SchoolYear_Name)"),
				"SchoolYear_Status"	=> 0
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
	public function index(int $Id_SchoolYear): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolYearModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolYearModel::query();

			$oQuery->where("Id_SchoolYear", "=", $Id_SchoolYear);
			$oQuery->where("SchoolYear_Status", "<>", "0");

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
	public function list(int $Id_School, SchoolYearFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolYearModel::getEntity();
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
			$oQuery	= SchoolYearModel::query();

			$oQuery->where("Id_School", "=", $Id_School);
			$oQuery->where('SchoolYear_Status', '=', SchoolYearStatus::ACTIVE->value);
			$oQuery->orderBy("SchoolYear_Year", "ASC");

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
	public function search(int $Id_School, SearchSchoolYearDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolYearModel::getEntity();
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
				SchoolYearFilterStatus::ACTIVE->value   => 2,
				SchoolYearFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolYearModel::query();

			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('SchoolYear_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('SchoolYear_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("SchoolYear_Name", "LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolYear_Year",	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("SchoolYear_Year", "ASC");
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
