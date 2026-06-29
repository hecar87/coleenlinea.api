<?php

namespace App\Modules\StudentGuardian\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\StudentGuardian\Domain\Repositories\IStudentGuardianRepository;
use App\Modules\StudentGuardian\Infrastructure\Persistence\EloquentStudentGuardian as StudentGuardianModel;

use App\Modules\StudentGuardian\Application\DTOs\CreateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\UpdateStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\DuplicatedStudentGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianDTO;

use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterDisplay;
use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterStatus;
use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianPublic;
use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianStatus;


class EloquentStudentGuardianRepository implements IStudentGuardianRepository
{
	public function getEntity(): string
	{
		return StudentGuardianModel::getEntity();
	}

	public function exists(int $Id_StudentGuardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentGuardianModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->where("Id_StudentGuardian", "=", $Id_StudentGuardian);
			$oQuery->where("StudentGuardian_Status", "<>", "0");

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
	public function duplicated(DuplicatedStudentGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentGuardianModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->where("Id_StudentGuardian", "<>", $dto->Id_StudentGuardian);
			$oQuery->where("StudentGuardian_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_TypeBank", "=", $dto->Id_TypeBank);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("StudentGuardian_Number", "=", $dto->StudentGuardian_Number);
				$oSubQuery->orWhere("StudentGuardian_CCI", "=", $dto->StudentGuardian_CCI);
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
	public function create(CreateStudentGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentGuardianModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_StudentGuardian"		=> $dto->Id_StudentGuardian,
				"StudentGuardian_Number"	=> trim( mb_strtoupper( $dto->StudentGuardian_Number, "utf-8" ) ),
				"StudentGuardian_CCI"		=> trim( mb_strtoupper( $dto->StudentGuardian_CCI, "utf-8" ) ),
				"StudentGuardian_Remark"	=> trim( mb_strtoupper( $dto->StudentGuardian_Remark, "utf-8" ) ),
				"StudentGuardian_Default"	=> 1,
				"StudentGuardian_Public"	=> $dto->StudentGuardian_Public,
				"StudentGuardian_Status"	=> $dto->StudentGuardian_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
			]);

			$oQuery->where("Id_StudentGuardian", "=", "$Id");
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
	public function update(UpdateStudentGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentGuardianModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= StudentGuardianModel::query();

			$oQuery->where("Id_StudentGuardian", "=", $dto->Id_StudentGuardian);
			$oQuery->update([
				"StudentGuardian_Number"	=> trim( mb_strtoupper( $dto->StudentGuardian_Number, "utf-8" ) ),
				"StudentGuardian_CCI"		=> trim( mb_strtoupper( $dto->StudentGuardian_CCI, "utf-8" ) ),
				"StudentGuardian_Remark"	=> trim( mb_strtoupper( $dto->StudentGuardian_Remark, "utf-8" ) ),
				"StudentGuardian_Default"	=> 1,
				"StudentGuardian_Public"	=> $dto->StudentGuardian_Public,
				"StudentGuardian_Status"	=> $dto->StudentGuardian_Status,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
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
	public function delete(int $Id_StudentGuardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentGuardianModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->where("Id_StudentGuardian", "=", $Id_StudentGuardian);
			$oQuery->update([
				"StudentGuardian_Number"	=> DB::raw("CONCAT('( DELETED ) ', StudentGuardian_Number)"),
				"StudentGuardian_CCI"		=> DB::raw("CONCAT('( DELETED ) ', StudentGuardian_CCI)"),
				"StudentGuardian_Status"	=> 0
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
	public function index(int $Id_StudentGuardian): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentGuardianModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_StudentGuardian", "=", $Id_StudentGuardian);
			$oQuery->where("StudentGuardian_Status", "<>", "0");

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
	public function list(int $Id_School, StudentGuardianFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentGuardianModel::getEntity();
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
				StudentGuardianFilterDisplay::PUBLIC->value  => 2,
				StudentGuardianFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('StudentGuardian_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('StudentGuardian_Status', '=', StudentGuardianStatus::ACTIVE->value);
			$oQuery->orderBy("StudentGuardian_Default", "DESC");
			$oQuery->orderBy("Id_StudentGuardian", "DESC");

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
	public function search(int $Id_School, SearchStudentGuardianDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentGuardianModel::getEntity();
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
				StudentGuardianFilterDisplay::PUBLIC->value  => 2,
				StudentGuardianFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				StudentGuardianFilterStatus::ACTIVE->value   => 2,
				StudentGuardianFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('StudentGuardian_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('StudentGuardian_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('StudentGuardian_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("StudentGuardian_Number", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("StudentGuardian_CCI", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("StudentGuardian_Remark", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Name", 			"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("StudentGuardian_Default", "DESC");
			$oQuery->orderBy("Id_StudentGuardian", "DESC");
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
