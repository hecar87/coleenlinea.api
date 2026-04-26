<?php

namespace App\Infrastructure\State\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Domain\State\Repositories\IStateRepository;
use App\Domain\State\Entities\State as StateEntity;
use App\Infrastructure\State\Persistence\EloquentState as StateModel;

use App\Application\State\DTOs\CreateStateDTO;
use App\Application\State\DTOs\UpdateStateDTO;
use App\Application\State\DTOs\DuplicatedStateDTO;
use App\Application\State\DTOs\SearchStateDTO;

use App\Domain\State\Enums\StateFilterDisplay;
use App\Domain\State\Enums\StateFilterStatus;
use App\Domain\State\Enums\StatePublic;
use App\Domain\State\Enums\StateStatus;


class EloquentStateRepository implements IStateRepository
{
	public function getEntity(): string
	{
		return StateModel::getEntity();
	}

	public function exists(int $Id_State): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StateModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StateModel::query();

			$oQuery->where("Id_State", "=", $Id_State);
			$oQuery->where("State_Status", "<>", "0");

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
	public function duplicated(DuplicatedStateDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StateModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StateModel::query();

			$oQuery->where("Id_State", "<>", $dto->Id_State);
			$oQuery->where("State_Status", "<>", "0");
			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("State_Code", "=", $dto->State_Code);
				$oSubQuery->orWhere("State_Name", "=", $dto->State_Name);
				$oSubQuery->orWhere("State_Abrv", "=", $dto->State_Abrv);
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
	public function create(CreateStateDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StateModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StateModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_State"		=> $dto->Id_State,
				"State_Code"	=> trim(mb_strtoupper($dto->State_Code, "utf-8")),
				"State_Name"	=> trim(mb_strtoupper($dto->State_Name, "utf-8")),
				"State_Abrv"	=> trim(mb_strtoupper($dto->State_Abrv, "utf-8")),
				"State_Public"	=> $dto->State_Public,
				"State_Status"	=> $dto->State_Status
			]);

			$oQuery->where("Id_State", "=", "$Id");
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
	public function update(UpdateStateDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StateModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= StateModel::query();

			$oQuery->where("Id_State", "=", $dto->Id_State);
			$oQuery->update([
				"State_Code"	=> trim(mb_strtoupper($dto->State_Code, "utf-8")),
				"State_Name"	=> trim(mb_strtoupper($dto->State_Name, "utf-8")),
				"State_Abrv"	=> trim(mb_strtoupper($dto->State_Abrv, "utf-8")),
				"State_Public"	=> $dto->State_Public,
				"State_Status"	=> $dto->State_Status
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
	public function delete(int $Id_State): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StateModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StateModel::query();

			$oQuery->where("Id_State", "=", $Id_State);
			$oQuery->update([
				"State_Name"	=> DB::raw("CONCAT('( DELETED ) ', State_Name)"),
				"State_Status"	=> 0
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
	public function index(int $Id_State): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StateModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StateModel::query();

			$oQuery->where("Id_State", "=", $Id_State);
			$oQuery->where("State_Status", "<>", "0");

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
	public function list(StateFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StateModel::getEntity();
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
				StateFilterDisplay::PUBLIC->value  => 2,
				StateFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StateModel::query();

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('State_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('State_Status', '=', StateStatus::ACTIVE->value);
			$oQuery->orderBy("State_Name", "ASC");

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult = ResultManager::Result(1005, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function search(SearchStateDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StateModel::getEntity();
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
				StateFilterDisplay::PUBLIC->value  => 2,
				StateFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				StateFilterStatus::ACTIVE->value   => 2,
				StateFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StateModel::query();

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('State_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('State_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('State_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("State_Code", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("State_Name", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("State_Abrv", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("State_Name", "ASC");
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
