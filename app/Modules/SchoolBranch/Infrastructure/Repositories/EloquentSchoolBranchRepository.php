<?php

namespace App\Modules\SchoolBranch\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\SchoolBranch\Domain\Repositories\ISchoolBranchRepository;
use App\Modules\SchoolBranch\Infrastructure\Persistence\EloquentSchoolBranch as SchoolBranchModel;

use App\Modules\SchoolBranch\Application\DTOs\CreateSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\UpdateSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\DuplicatedSchoolBranchDTO;
use App\Modules\SchoolBranch\Application\DTOs\SearchSchoolBranchDTO;

use App\Modules\SchoolBranch\Domain\Enums\SchoolBranchFilterDisplay;
use App\Modules\SchoolBranch\Domain\Enums\SchoolBranchFilterStatus;
use App\Modules\SchoolBranch\Domain\Enums\SchoolBranchPublic;
use App\Modules\SchoolBranch\Domain\Enums\SchoolBranchStatus;


class EloquentSchoolBranchRepository implements ISchoolBranchRepository
{
	public function getEntity(): string
	{
		return SchoolBranchModel::getEntity();
	}

	public function exists(int $Id_SchoolBranch): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolBranchModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolBranchModel::query();

			$oQuery->where("Id_SchoolBranch", "=", $Id_SchoolBranch);
			$oQuery->where("SchoolBranch_Status", "<>", "0");

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
	public function duplicated(DuplicatedSchoolBranchDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolBranchModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolBranchModel::query();

			$oQuery->where("Id_SchoolBranch", "<>", $dto->Id_SchoolBranch);
			$oQuery->where("SchoolBranch_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("SchoolBranch_Code", "=", $dto->SchoolBranch_Code);
				$oSubQuery->orWhere("SchoolBranch_Name", "=", $dto->SchoolBranch_Name);
				$oSubQuery->orWhere("SchoolBranch_Address", "=", $dto->SchoolBranch_Address);
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
	public function create(CreateSchoolBranchDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolBranchModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolBranchModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_SchoolBranch"		=> $dto->Id_SchoolBranch,
				"SchoolBranch_Code"		=> trim( mb_strtoupper( $dto->SchoolBranch_Code, "utf-8" ) ),
				"SchoolBranch_Name"		=> trim( mb_strtoupper( $dto->SchoolBranch_Name, "utf-8" ) ),
				"SchoolBranch_Address"	=> trim( mb_strtoupper( $dto->SchoolBranch_Address, "utf-8" ) ),
				"SchoolBranch_Phone"	=> trim( mb_strtoupper( $dto->SchoolBranch_Phone, "utf-8" ) ),
				"SchoolBranch_LAT"		=> $dto->SchoolBranch_LAT,
				"SchoolBranch_LNG"		=> $dto->SchoolBranch_LNG,
				"SchoolBranch_Public"	=> $dto->SchoolBranch_Public,
				"SchoolBranch_Status"	=> $dto->SchoolBranch_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District
			]);

			$oQuery->where("Id_SchoolBranch", "=", "$Id");
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
	public function update(UpdateSchoolBranchDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolBranchModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= SchoolBranchModel::query();

			$oQuery->where("Id_SchoolBranch", "=", $dto->Id_SchoolBranch);
			$oQuery->update([
				"SchoolBranch_Code"		=> trim( mb_strtoupper( $dto->SchoolBranch_Code, "utf-8" ) ),
				"SchoolBranch_Name"		=> trim( mb_strtoupper( $dto->SchoolBranch_Name, "utf-8" ) ),
				"SchoolBranch_Address"	=> trim( mb_strtoupper( $dto->SchoolBranch_Address, "utf-8" ) ),
				"SchoolBranch_Phone"	=> trim( mb_strtoupper( $dto->SchoolBranch_Phone, "utf-8" ) ),
				"SchoolBranch_LAT"		=> $dto->SchoolBranch_LAT,
				"SchoolBranch_LNG"		=> $dto->SchoolBranch_LNG,
				"SchoolBranch_Public"	=> $dto->SchoolBranch_Public,
				"SchoolBranch_Status"	=> $dto->SchoolBranch_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District
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
	public function delete(int $Id_SchoolBranch): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolBranchModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolBranchModel::query();

			$oQuery->where("Id_SchoolBranch", "=", $Id_SchoolBranch);
			$oQuery->update([
				"SchoolBranch_Name"		=> DB::raw("CONCAT('( DELETED ) ', SchoolBranch_Name)"),
				"SchoolBranch_Status"	=> 0
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
	public function index(int $Id_SchoolBranch): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolBranchModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolBranchModel::query();

			$oQuery->join("t_state", "t_school_branch.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school_branch.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school_branch.Id_District", "=", "t_district.Id_District");
			$oQuery->where("Id_SchoolBranch", "=", $Id_SchoolBranch);
			$oQuery->where("SchoolBranch_Status", "<>", "0");

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
	public function list(int $Id_School, SchoolBranchFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolBranchModel::getEntity();
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
				SchoolBranchFilterDisplay::PUBLIC->value  => 2,
				SchoolBranchFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolBranchModel::query();

			$oQuery->join("t_state", "t_school_branch.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school_branch.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school_branch.Id_District", "=", "t_district.Id_District");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('SchoolBranch_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('SchoolBranch_Status', '=', SchoolBranchStatus::ACTIVE->value);
			$oQuery->orderBy("SchoolBranch_Name", "DESC");

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
	public function search(int $Id_School, SearchSchoolBranchDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolBranchModel::getEntity();
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
				SchoolBranchFilterDisplay::PUBLIC->value  => 2,
				SchoolBranchFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				SchoolBranchFilterStatus::ACTIVE->value   => 2,
				SchoolBranchFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolBranchModel::query();

			$oQuery->join("t_state", "t_school_branch.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school_branch.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school_branch.Id_District", "=", "t_district.Id_District");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('SchoolBranch_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('SchoolBranch_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('SchoolBranch_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("SchoolBranch_Code", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolBranch_Name",	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("SchoolBranch_Name", "DESC");
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
