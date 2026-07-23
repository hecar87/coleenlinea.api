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

use App\Modules\SchoolProfile\Domain\Enums\SchoolProfileFilterStatus;
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
			$oQuery->where("SchoolProfile_Name", "=", $dto->SchoolProfile_Name);
			$oQuery->where("SchoolProfile_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_SchoolYear", "=", $dto->Id_SchoolYear);
			$oQuery->where("Id_SchoolLevel", "=", $dto->Id_SchoolLevel);

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
				"Id_SchoolProfile"				=> $dto->Id_SchoolProfile,
				"SchoolProfile_Name"			=> trim( mb_strtoupper( $dto->SchoolProfile_Name, "utf-8" ) ),
				"SchoolProfile_Description"		=> trim( mb_strtoupper( $dto->SchoolProfile_Description, "utf-8" ) ),
				"SchoolProfile_Newed"			=> $dto->SchoolProfile_Newed,
				"SchoolProfile_Type"			=> $dto->SchoolProfile_Type,
				"SchoolProfile_Status"			=> $dto->SchoolProfile_Status,
				"Id_School"						=> $dto->Id_School,
				"Id_SchoolYear"					=> $dto->Id_SchoolYear,
				"Id_SchoolLevel"				=> $dto->Id_SchoolLevel
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
				"SchoolProfile_Name"			=> trim( mb_strtoupper( $dto->SchoolProfile_Name, "utf-8" ) ),
				"SchoolProfile_Description"		=> trim( mb_strtoupper( $dto->SchoolProfile_Description, "utf-8" ) ),
				"SchoolProfile_Newed"			=> $dto->SchoolProfile_Newed,
				"SchoolProfile_Type"			=> $dto->SchoolProfile_Type,
				"SchoolProfile_Status"			=> $dto->SchoolProfile_Status,
				"Id_School"						=> $dto->Id_School,
				"Id_SchoolYear"					=> $dto->Id_SchoolYear,
				"Id_SchoolLevel"				=> $dto->Id_SchoolLevel
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
				"SchoolProfile_Name"			=> DB::raw("CONCAT('( DELETED ) ', SchoolProfile_Name)"),
				"SchoolProfile_Status"			=> 0
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

			$oQuery->join("t_school_year", "t_school_profile.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_level", "t_school_profile.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
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
	public function list(int $Id_School): Result
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


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$oQuery->join("t_school_year", "t_school_profile.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_level", "t_school_profile.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
			$oQuery->where("Id_School", "=", $Id_School);
			$oQuery->where('SchoolProfile_Status', '=', SchoolProfileStatus::ACTIVE->value);
			$oQuery->orderBy("SchoolProfile_Name", "ASC");

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

			$whereStatus	= [
				SchoolProfileFilterStatus::ACTIVE->value   => 2,
				SchoolProfileFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolProfileModel::query();

			$oQuery->join("t_school_year", "t_school_profile.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_level", "t_school_profile.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('SchoolProfile_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('SchoolProfile_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("SchoolProfile_Name", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolYear_Name", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolLevel_Code",	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("SchoolProfile_Name", "ASC");
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
