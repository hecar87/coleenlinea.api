<?php

namespace App\Modules\Guardian\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;
use App\Modules\Guardian\Infrastructure\Persistence\EloquentGuardian as GuardianModel;

use App\Modules\Guardian\Application\DTOs\CreateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\UpdateGuardianDTO;
use App\Modules\Guardian\Application\DTOs\DuplicatedGuardianDTO;
use App\Modules\Guardian\Application\DTOs\SearchGuardianDTO;

use App\Modules\Guardian\Domain\Enums\GuardianFilterVerified;
use App\Modules\Guardian\Domain\Enums\GuardianFilterStatus;
use App\Modules\Guardian\Domain\Enums\GuardianVerified;
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
	public function canVerify(int $Id_Guardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oResult	= [];
		$Validate	= false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->where("Guardian_Verified", "=", "1");

			$oData	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
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
	public function canActivate(int $Id_Guardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oResult	= [];
		$Validate	= false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->where("Guardian_Status", "=", "1");

			$oData	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
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
	public function canDeactivate(int $Id_Guardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= GuardianModel::getEntity();
		$oResult	= [];
		$Validate	= false;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->where("Guardian_Status", "=", "2");

			$oData	= $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
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

			$pGuardian_Code = $this->generateCode();

			$Id 	= $oQuery->insertGetId([
				"Id_Guardian"				=> $dto->Id_Guardian,
				"Guardian_Date_Created"		=> date("Y-m-d H:i:s"),
				"Guardian_Date_Updated"		=> date("Y-m-d H:i:s"),
				"Guardian_Date_Deleted"		=> date("Y-m-d H:i:s"),
				"Guardian_Date_Verified"	=> date("Y-m-d H:i:s"),
				"Guardian_Code"				=> $pGuardian_Code,
				"Guardian_Name"				=> trim( mb_strtoupper( $dto->Guardian_Name, "utf-8" ) ),
				"Guardian_LastName"			=> trim( mb_strtoupper( $dto->Guardian_LastName, "utf-8" ) ),
				"Guardian_NoDocument"		=> trim( mb_strtoupper( $dto->Guardian_NoDocument, "utf-8" ) ),
				"Guardian_DOB"				=> $dto->Guardian_DOB,
				"Guardian_Verified"			=> 1,
				"Guardian_Status"			=> 2,
				"Id_TypeDocument"			=> $dto->Id_TypeDocument,
				"Id_TypeGender"				=> $dto->Id_TypeGender
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
				"Guardian_Date_Updated"		=> date("Y-m-d H:i:s"),
				"Guardian_Name"				=> trim( mb_strtoupper( $dto->Guardian_Name, "utf-8" ) ),
				"Guardian_LastName"			=> trim( mb_strtoupper( $dto->Guardian_LastName, "utf-8" ) ),
				"Guardian_NoDocument"		=> trim( mb_strtoupper( $dto->Guardian_NoDocument, "utf-8" ) ),
				"Guardian_DOB"				=> $dto->Guardian_DOB,
				"Id_TypeDocument"			=> $dto->Id_TypeDocument,
				"Id_TypeGender"				=> $dto->Id_TypeGender
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
				"Guardian_Code"	=> DB::raw("CONCAT('( DELETED ) ', Guardian_Code)"),
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

			$oQuery->join("t_type_document", "t_guardian.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_gender", "t_guardian.Id_TypeGender", "=", "t_type_gender.Id_TypeGender");
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
	public function list(GuardianFilterVerified $Display): Result
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
			$whereVerified	= [
				GuardianFilterVerified::VERIFIED->value  => 2,
				GuardianFilterVerified::PENDING->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->join("t_type_document", "t_guardian.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_gender", "t_guardian.Id_TypeGender", "=", "t_type_gender.Id_TypeGender");

			if (isset($whereVerified[$Display->value])) {
				$oQuery->where('Guardian_Verified', $whereVerified[$Display->value]);
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

			$whereVerified	= [
				GuardianFilterVerified::VERIFIED->value  => 2,
				GuardianFilterVerified::PENDING->value => 1
			];
			$whereStatus	= [
				GuardianFilterStatus::ACTIVE->value   => 2,
				GuardianFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= GuardianModel::query();

			$oQuery->join("t_type_document", "t_guardian.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_gender", "t_guardian.Id_TypeGender", "=", "t_type_gender.Id_TypeGender");

			if (isset($whereVerified[$dto->Verified->value])) {
				$oQuery->where('Guardian_Verified', $whereVerified[$dto->Verified->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Guardian_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Guardian_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Guardian_Name", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Guardian_LastName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Guardian_NoDocument", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Guardian_LastName", "ASC");
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
	public function verify(int $Id_Guardian): Result
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

			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->update([
				"Guardian_Date_Verified"	=> now(),
				"Guardian_Verified"			=> 2,
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1000, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function activate(int $Id_Guardian): Result
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

			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->update([
				"Guardian_Status" => 2
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1000, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
	public function deactivate(int $Id_Guardian): Result
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

			$oQuery->where("Id_Guardian", "=", $Id_Guardian);
			$oQuery->update([
				"Guardian_Verified" => 1
			]);

			$oData	= $oQuery->get();


			//
			//	FUNCTION
			//
			$oResult	= ResultManager::Result(1000, $oEntity, $oData);
		} catch (\Exception $oException) {
			$oResult = ResultManager::Result(2100, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}


	private function generateCode(): string
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

			$oResult = Str::orderedUuid()->getHex()->toString();
		} catch (\Exception $oException) {
			$oResult = "ERCODE";
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}
