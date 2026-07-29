<?php

namespace App\Modules\Charge\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Charge\Domain\Repositories\IChargeRepository;
use App\Modules\Charge\Infrastructure\Persistence\EloquentCharge as ChargeModel;

use App\Modules\Charge\Application\DTOs\CreateChargeDTO;
use App\Modules\Charge\Application\DTOs\UpdateChargeDTO;
use App\Modules\Charge\Application\DTOs\DuplicatedChargeDTO;
use App\Modules\Charge\Application\DTOs\SearchChargeDTO;

use App\Modules\Charge\Domain\Enums\ChargeFilterDisplay;
use App\Modules\Charge\Domain\Enums\ChargeFilterStatus;
use App\Modules\Charge\Domain\Enums\ChargePublic;
use App\Modules\Charge\Domain\Enums\ChargeStatus;


class EloquentChargeRepository implements IChargeRepository
{
	public function getEntity(): string
	{
		return ChargeModel::getEntity();
	}

	public function exists(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->where("Charge_Status", "<>", "0");

			$exists = $oQuery->count();


			//
			//	FUNCTION
			//
			if ($exists == 1) {
				$oResult = ResultManager::Result(1000, $oEntity);
			} else {
				$oResult = ResultManager::Result(2200, $oEntity);
			}
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function duplicated(DuplicatedChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "<>", $dto->Id_Charge);
			$oQuery->where("Charge_Status", "<>", "0");
			$oQuery->where("Charge_NoDocument", "=", $dto->Charge_NoDocument);
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
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function create(CreateChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$pCharge_Code = $this->generateCode($dto->Id_State, $dto->Id_City, $dto->Id_District, $dto->Id_TypeCharge);

			$Id 	= $oQuery->insertGetId([
				"Id_Charge"				=> $dto->Id_Charge,
				"Charge_Code"			=> $pCharge_Code,
				"Charge_BusinessName"	=> trim(mb_strtoupper($dto->Charge_BusinessName, "utf-8" ) ),
				"Charge_TradeName"		=> trim(mb_strtoupper($dto->Charge_TradeName, "utf-8" ) ),
				"Charge_NoDocument"		=> trim(mb_strtoupper($dto->Charge_NoDocument, "utf-8" ) ),
				"Charge_Address"		=> trim(mb_strtoupper($dto->Charge_Address, "utf-8" ) ),
				"Charge_Phone"			=> trim(mb_strtoupper($dto->Charge_Phone, "utf-8" ) ),
				"Charge_Public"			=> $dto->Charge_Public,
				"Charge_Status"			=> $dto->Charge_Status,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District,
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"Id_TypeCharge"			=> $dto->Id_TypeCharge
			]);

			$oQuery->where("Id_Charge", "=", "$Id");
			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1001, $oEntity, $oData);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function update(UpdateChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $dto->Id_Charge);
			$oQuery->update([
				"Charge_BusinessName"	=> trim(mb_strtoupper($dto->Charge_BusinessName, "utf-8" ) ),
				"Charge_TradeName"		=> trim(mb_strtoupper($dto->Charge_TradeName, "utf-8" ) ),
				"Charge_NoDocument"		=> trim(mb_strtoupper($dto->Charge_NoDocument, "utf-8" ) ),
				"Charge_Address"		=> trim(mb_strtoupper($dto->Charge_Address, "utf-8" ) ),
				"Charge_Phone"			=> trim(mb_strtoupper($dto->Charge_Phone, "utf-8" ) ),
				"Charge_Public"			=> $dto->Charge_Public,
				"Charge_Status"			=> $dto->Charge_Status,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District,
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"Id_TypeCharge"			=> $dto->Id_TypeCharge
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1002, $oEntity, $oData);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function delete(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->update([
				"Charge_Name"	=> DB::raw("CONCAT('( DELETED ) ', Charge_Name)"),
				"Charge_Status"	=> 0
			]);


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1003, $oEntity);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function index(int $Id_Charge): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeCharge", "=", "t_type_school.Id_TypeCharge");
			$oQuery->where("Id_Charge", "=", $Id_Charge);
			$oQuery->where("Charge_Status", "<>", "0");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1004, $oEntity, $oData);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function list(ChargeFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
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
				ChargeFilterDisplay::PUBLIC->value  => 2,
				ChargeFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeCharge", "=", "t_type_school.Id_TypeCharge");

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('Charge_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('Charge_Status', '=', ChargeStatus::ACTIVE->value);
			$oQuery->orderBy("Charge_TradeName", "ASC");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1005, $oEntity, $oData);
		}
		catch (\Throwable $oException)
		{
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function search(SearchChargeDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
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
				ChargeFilterDisplay::PUBLIC->value  => 2,
				ChargeFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				ChargeFilterStatus::ACTIVE->value   => 2,
				ChargeFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= ChargeModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeCharge", "=", "t_type_school.Id_TypeCharge");

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('Charge_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Charge_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Charge_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Charge_Code", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_BusinessName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_TradeName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Charge_NoDocument", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Charge_TradeName", "ASC");
			$oQuery->limit($Page_Size);
			$oQuery->offset($Page_Offset);

			// GET DATA
			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1006, $oEntity, $oData, $Data_Total);
		} catch (\Throwable $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}


	private function generateCode(int $Id_State, int $Id_City, int $Id_District, int $Id_TypeCharge): string
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= ChargeModel::getEntity();
		$oResult	= "";


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oRow				= ChargeModel::orderBy("Id_Charge", "DESC")->get()->first();
			$New_Id				= $oRow == null ? 1 : $oRow->Id_Charge + 1;

			$Code_Charge		= str_pad( $New_Id, 6, "0", STR_PAD_LEFT );
			$Code_State			= str_pad( $Id_State, 2, "0", STR_PAD_LEFT );
			$Code_City			= str_pad( $Id_City, 3, "0", STR_PAD_LEFT );
			$Code_District		= str_pad( $Id_District, 4, "0", STR_PAD_LEFT );
			$Code_TypeCharge	= str_pad( $Id_TypeCharge, 2, "0", STR_PAD_LEFT );

			$oResult			= "SC".$Code_TypeCharge.$Code_State.$Code_City.$Code_District.$Code_Charge;
		} catch (\Throwable $oException) {
			$oResult = "ERCODE";
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}
