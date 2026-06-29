<?php

namespace App\Modules\Enrollment\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\Enrollment\Infrastructure\Persistence\EloquentEnrollment as EnrollmentModel;

use App\Modules\Enrollment\Application\DTOs\CreateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\UpdateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\DuplicatedEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentDTO;

use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterDisplay;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterStatus;
use App\Modules\Enrollment\Domain\Enums\EnrollmentPublic;
use App\Modules\Enrollment\Domain\Enums\EnrollmentStatus;


class EloquentEnrollmentRepository implements IEnrollmentRepository
{
	public function getEntity(): string
	{
		return EnrollmentModel::getEntity();
	}

	public function exists(int $Id_Enrollment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->where("Enrollment_Status", "<>", "0");

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
	public function duplicated(DuplicatedEnrollmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->where("Id_Enrollment", "<>", $dto->Id_Enrollment);
			$oQuery->where("Enrollment_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_TypeBank", "=", $dto->Id_TypeBank);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Enrollment_Number", "=", $dto->Enrollment_Number);
				$oSubQuery->orWhere("Enrollment_CCI", "=", $dto->Enrollment_CCI);
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
	public function create(CreateEnrollmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_Enrollment"		=> $dto->Id_Enrollment,
				"Enrollment_Number"	=> trim( mb_strtoupper( $dto->Enrollment_Number, "utf-8" ) ),
				"Enrollment_CCI"		=> trim( mb_strtoupper( $dto->Enrollment_CCI, "utf-8" ) ),
				"Enrollment_Remark"	=> trim( mb_strtoupper( $dto->Enrollment_Remark, "utf-8" ) ),
				"Enrollment_Default"	=> 1,
				"Enrollment_Public"	=> $dto->Enrollment_Public,
				"Enrollment_Status"	=> $dto->Enrollment_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
			]);

			$oQuery->where("Id_Enrollment", "=", "$Id");
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
	public function update(UpdateEnrollmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= EnrollmentModel::query();

			$oQuery->where("Id_Enrollment", "=", $dto->Id_Enrollment);
			$oQuery->update([
				"Enrollment_Number"	=> trim( mb_strtoupper( $dto->Enrollment_Number, "utf-8" ) ),
				"Enrollment_CCI"		=> trim( mb_strtoupper( $dto->Enrollment_CCI, "utf-8" ) ),
				"Enrollment_Remark"	=> trim( mb_strtoupper( $dto->Enrollment_Remark, "utf-8" ) ),
				"Enrollment_Default"	=> 1,
				"Enrollment_Public"	=> $dto->Enrollment_Public,
				"Enrollment_Status"	=> $dto->Enrollment_Status,
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
	public function delete(int $Id_Enrollment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->update([
				"Enrollment_Number"	=> DB::raw("CONCAT('( DELETED ) ', Enrollment_Number)"),
				"Enrollment_CCI"		=> DB::raw("CONCAT('( DELETED ) ', Enrollment_CCI)"),
				"Enrollment_Status"	=> 0
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
	public function index(int $Id_Enrollment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->where("Enrollment_Status", "<>", "0");

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
	public function list(int $Id_School, EnrollmentFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
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
				EnrollmentFilterDisplay::PUBLIC->value  => 2,
				EnrollmentFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('Enrollment_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('Enrollment_Status', '=', EnrollmentStatus::ACTIVE->value);
			$oQuery->orderBy("Enrollment_Default", "DESC");
			$oQuery->orderBy("Id_Enrollment", "DESC");

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
	public function search(int $Id_School, SearchEnrollmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
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
				EnrollmentFilterDisplay::PUBLIC->value  => 2,
				EnrollmentFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				EnrollmentFilterStatus::ACTIVE->value   => 2,
				EnrollmentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('Enrollment_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Enrollment_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Enrollment_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("Enrollment_Number", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Enrollment_CCI", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Enrollment_Remark", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Name", 			"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Enrollment_Default", "DESC");
			$oQuery->orderBy("Id_Enrollment", "DESC");
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
