<?php

namespace App\Modules\Guardian\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;
use App\Modules\Guardian\Infrastructure\Persistence\EloquentGuardian as GuardianModel;

use App\Modules\Guardian\Application\DTOs\CreateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\UpdateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\DuplicatedGuardianDTO;
use App\Modules\Guardian\Application\DTOs\SearchGuardianDTO;

use App\Modules\Guardian\Domain\Enums\GuardianFilterDisplay;
use App\Modules\Guardian\Domain\Enums\GuardianFilterStatus;
use App\Modules\Guardian\Domain\Enums\GuardianPublic;
use App\Modules\Guardian\Domain\Enums\GuardianStatus;


class EloquentGuardianRepository implements IGuardianRepository
{
	public function getEntity(): string
	{
		return GuardianModel::getEntity();
	}

	public function exists(int $Id_Guardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->where("Guardian_Status", "<>", "0");

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
	public function duplicated(DuplicatedGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->where("Id_Guardian", "<>", $dto->Id_Guardian);
			$oQuery->where("Guardian_Status", "<>", "0");
			$oQuery->where("Guardian_NoDocument", "=", $dto->Guardian_NoDocument);
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
	public function create(CreateGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$pGuardian_Code = $this->generateCode($dto->Id_State, $dto->Id_City, $dto->Id_District, $dto->Id_TypeGuardian);

			$Id 	= $oQuery->insertGetId([
				"Id_Guardian"				=> $dto->Id_Guardian,
				"Guardian_Code"			=> $pGuardian_Code,
				"Guardian_BusinessName"	=> trim(mb_strtoupper($dto->Guardian_BusinessName, "utf-8" ) ),
				"Guardian_TradeName"		=> trim(mb_strtoupper($dto->Guardian_TradeName, "utf-8" ) ),
				"Guardian_NoDocument"		=> trim(mb_strtoupper($dto->Guardian_NoDocument, "utf-8" ) ),
				"Guardian_Address"		=> trim(mb_strtoupper($dto->Guardian_Address, "utf-8" ) ),
				"Guardian_Phone"			=> trim(mb_strtoupper($dto->Guardian_Phone, "utf-8" ) ),
				"Guardian_Public"			=> $dto->Guardian_Public,
				"Guardian_Status"			=> $dto->Guardian_Status,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District,
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"Id_TypeGuardian"			=> $dto->Id_TypeGuardian
			]);

			$oQuery->where("Id_Guardian", "=", "$Id");
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
	public function update(UpdateGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= GuardianModel::query();

			$oQuery->where("Id_Guardian", "=", $dto->Id_Guardian);
			$oQuery->update([
				"Guardian_BusinessName"	=> trim(mb_strtoupper($dto->Guardian_BusinessName, "utf-8" ) ),
				"Guardian_TradeName"		=> trim(mb_strtoupper($dto->Guardian_TradeName, "utf-8" ) ),
				"Guardian_NoDocument"		=> trim(mb_strtoupper($dto->Guardian_NoDocument, "utf-8" ) ),
				"Guardian_Address"		=> trim(mb_strtoupper($dto->Guardian_Address, "utf-8" ) ),
				"Guardian_Phone"			=> trim(mb_strtoupper($dto->Guardian_Phone, "utf-8" ) ),
				"Guardian_Public"			=> $dto->Guardian_Public,
				"Guardian_Status"			=> $dto->Guardian_Status,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District,
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"Id_TypeGuardian"			=> $dto->Id_TypeGuardian
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
	public function delete(int $Id_Guardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->update([
				"Guardian_Name"	=> DB::raw("CONCAT('( DELETED ) ', Guardian_Name)"),
				"Guardian_Status"	=> 0
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
	public function index(int $Id_Guardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeGuardian", "=", "t_type_school.Id_TypeGuardian");
			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->where("Guardian_Status", "<>", "0");

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
	public function list(GuardianFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
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
				GuardianFilterDisplay::PUBLIC->value  => 2,
				GuardianFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeGuardian", "=", "t_type_school.Id_TypeGuardian");

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('Guardian_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('Guardian_Status', '=', GuardianStatus::ACTIVE->value);
			$oQuery->orderBy("Guardian_TradeName", "ASC");

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
	public function search(SearchGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
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
				GuardianFilterDisplay::PUBLIC->value  => 2,
				GuardianFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				GuardianFilterStatus::ACTIVE->value   => 2,
				GuardianFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeGuardian", "=", "t_type_school.Id_TypeGuardian");

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('Guardian_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Guardian_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Guardian_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Guardian_Code", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Guardian_BusinessName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Guardian_TradeName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Guardian_NoDocument", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Guardian_TradeName", "ASC");
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


	private function generateCode(int $Id_State, int $Id_City, int $Id_District, int $Id_TypeGuardian): string
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oResult	= "";


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oRow				= GuardianModel::orderBy("Id_Guardian", "DESC")->get()->first();
			$New_Id				= $oRow == null ? 1 : $oRow->Id_Guardian + 1;

			$Code_Guardian		= str_pad( $New_Id, 6, "0", STR_PAD_LEFT );
			$Code_State			= str_pad( $Id_State, 2, "0", STR_PAD_LEFT );
			$Code_City			= str_pad( $Id_City, 3, "0", STR_PAD_LEFT );
			$Code_District		= str_pad( $Id_District, 4, "0", STR_PAD_LEFT );
			$Code_TypeGuardian	= str_pad( $Id_TypeGuardian, 2, "0", STR_PAD_LEFT );

			$oResult			= "SC".$Code_TypeGuardian.$Code_State.$Code_City.$Code_District.$Code_Guardian;
		} catch (\Exception $oException) {
			$oResult = "ERCODE";
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}
