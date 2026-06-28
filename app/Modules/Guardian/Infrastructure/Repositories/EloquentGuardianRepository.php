<?php

namespace App\Modules\School\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\School\Infrastructure\Persistence\EloquentSchool as SchoolModel;

use App\Modules\School\Application\DTOs\CreateSchoolDTO;
use App\Modules\School\Application\DTOs\UpdateSchoolDTO;
use App\Modules\School\Application\DTOs\DuplicatedSchoolDTO;
use App\Modules\School\Application\DTOs\SearchSchoolDTO;

use App\Modules\School\Domain\Enums\SchoolFilterDisplay;
use App\Modules\School\Domain\Enums\SchoolFilterStatus;
use App\Modules\School\Domain\Enums\SchoolPublic;
use App\Modules\School\Domain\Enums\SchoolStatus;


class EloquentSchoolRepository implements ISchoolRepository
{
	public function getEntity(): string
	{
		return SchoolModel::getEntity();
	}

	public function exists(int $Id_School): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolModel::query();

			$oQuery->where("Id_School", "=", $Id_School);
			$oQuery->where("School_Status", "<>", "0");

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
	public function duplicated(DuplicatedSchoolDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolModel::query();

			$oQuery->where("Id_School", "<>", $dto->Id_School);
			$oQuery->where("School_Status", "<>", "0");
			$oQuery->where("School_NoDocument", "=", $dto->School_NoDocument);
			$oQuery->where("Id_TypeDocument", "=", $dto->Id_TypeDocument);

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
	public function create(CreateSchoolDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolModel::query();

			$pSchool_Code = $this->generateCode($dto->Id_State, $dto->Id_City, $dto->Id_District, $dto->Id_TypeSchool);

			$Id 	= $oQuery->insertGetId([
				"Id_School"				=> $dto->Id_School,
				"School_Code"			=> $pSchool_Code,
				"School_BusinessName"	=> trim(mb_strtoupper($dto->School_BusinessName, "utf-8" ) ),
				"School_TradeName"		=> trim(mb_strtoupper($dto->School_TradeName, "utf-8" ) ),
				"School_NoDocument"		=> trim(mb_strtoupper($dto->School_NoDocument, "utf-8" ) ),
				"School_Address"		=> trim(mb_strtoupper($dto->School_Address, "utf-8" ) ),
				"School_Phone"			=> trim(mb_strtoupper($dto->School_Phone, "utf-8" ) ),
				"School_Public"			=> $dto->School_Public,
				"School_Status"			=> $dto->School_Status,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District,
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"Id_TypeSchool"			=> $dto->Id_TypeSchool
			]);

			$oQuery->where("Id_School", "=", "$Id");
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
	public function update(UpdateSchoolDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= SchoolModel::query();

			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->update([
				"School_BusinessName"	=> trim(mb_strtoupper($dto->School_BusinessName, "utf-8" ) ),
				"School_TradeName"		=> trim(mb_strtoupper($dto->School_TradeName, "utf-8" ) ),
				"School_NoDocument"		=> trim(mb_strtoupper($dto->School_NoDocument, "utf-8" ) ),
				"School_Address"		=> trim(mb_strtoupper($dto->School_Address, "utf-8" ) ),
				"School_Phone"			=> trim(mb_strtoupper($dto->School_Phone, "utf-8" ) ),
				"School_Public"			=> $dto->School_Public,
				"School_Status"			=> $dto->School_Status,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District,
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"Id_TypeSchool"			=> $dto->Id_TypeSchool
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
	public function delete(int $Id_School): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolModel::query();

			$oQuery->where("Id_School", "=", $Id_School);
			$oQuery->update([
				"School_Name"	=> DB::raw("CONCAT('( DELETED ) ', School_Name)"),
				"School_Status"	=> 0
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
	public function index(int $Id_School): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeSchool", "=", "t_type_school.Id_TypeSchool");
			$oQuery->where("Id_School", "=", $Id_School);
			$oQuery->where("School_Status", "<>", "0");

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
	public function list(SchoolFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
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
				SchoolFilterDisplay::PUBLIC->value  => 2,
				SchoolFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeSchool", "=", "t_type_school.Id_TypeSchool");

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('School_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('School_Status', '=', SchoolStatus::ACTIVE->value);
			$oQuery->orderBy("School_TradeName", "ASC");

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
	public function search(SearchSchoolDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
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
				SchoolFilterDisplay::PUBLIC->value  => 2,
				SchoolFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				SchoolFilterStatus::ACTIVE->value   => 2,
				SchoolFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeSchool", "=", "t_type_school.Id_TypeSchool");

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('School_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('School_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('School_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("School_Code", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("School_BusinessName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("School_TradeName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("School_NoDocument", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("School_TradeName", "ASC");
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


	private function generateCode(int $Id_State, int $Id_City, int $Id_District, int $Id_TypeSchool): string
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolModel::getEntity();
		$oResult	= "";


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oRow				= SchoolModel::orderBy("Id_School", "DESC")->get()->first();
			$New_Id				= $oRow == null ? 1 : $oRow->Id_School + 1;

			$Code_School		= str_pad( $New_Id, 6, "0", STR_PAD_LEFT );
			$Code_State			= str_pad( $Id_State, 2, "0", STR_PAD_LEFT );
			$Code_City			= str_pad( $Id_City, 3, "0", STR_PAD_LEFT );
			$Code_District		= str_pad( $Id_District, 4, "0", STR_PAD_LEFT );
			$Code_TypeSchool	= str_pad( $Id_TypeSchool, 2, "0", STR_PAD_LEFT );

			$oResult			= "SC".$Code_TypeSchool.$Code_State.$Code_City.$Code_District.$Code_School;
		} catch (\Exception $oException) {
			$oResult = "ERCODE";
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}
