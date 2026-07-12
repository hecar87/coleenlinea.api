<?php

namespace App\Modules\EnrollmentInstallment\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\EnrollmentInstallment\Domain\Repositories\IEnrollmentInstallmentRepository;
use App\Modules\EnrollmentInstallment\Infrastructure\Persistence\EloquentEnrollmentInstallment as EnrollmentInstallmentModel;

use App\Modules\EnrollmentInstallment\Application\DTOs\CreateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\UpdateEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\DuplicatedEnrollmentInstallmentDTO;
use App\Modules\EnrollmentInstallment\Application\DTOs\SearchEnrollmentInstallmentDTO;

use App\Modules\EnrollmentInstallment\Domain\Enums\EnrollmentInstallmentFilterDisplay;
use App\Modules\EnrollmentInstallment\Domain\Enums\EnrollmentInstallmentFilterStatus;
use App\Modules\EnrollmentInstallment\Domain\Enums\EnrollmentInstallmentPublic;
use App\Modules\EnrollmentInstallment\Domain\Enums\EnrollmentInstallmentStatus;


class EloquentEnrollmentInstallmentRepository implements IEnrollmentInstallmentRepository
{
	public function getEntity(): string
	{
		return EnrollmentInstallmentModel::getEntity();
	}

	public function exists(int $Id_EnrollmentInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->where("Id_EnrollmentInstallment", "=", $Id_EnrollmentInstallment);
			$oQuery->where("EnrollmentInstallment_Status", "<>", "0");

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
	public function duplicated(DuplicatedEnrollmentInstallmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->where("Id_EnrollmentInstallment", "<>", $dto->Id_EnrollmentInstallment);
			$oQuery->where("EnrollmentInstallment_Status", "<>", "0");
			$oQuery->where("Id_School", "=", $dto->Id_School);
			$oQuery->where("Id_TypeBank", "=", $dto->Id_TypeBank);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("EnrollmentInstallment_Number", "=", $dto->EnrollmentInstallment_Number);
				$oSubQuery->orWhere("EnrollmentInstallment_CCI", "=", $dto->EnrollmentInstallment_CCI);
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
	public function create(CreateEnrollmentInstallmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_EnrollmentInstallment"		=> $dto->Id_EnrollmentInstallment,
				"EnrollmentInstallment_Number"	=> trim( mb_strtoupper( $dto->EnrollmentInstallment_Number, "utf-8" ) ),
				"EnrollmentInstallment_CCI"		=> trim( mb_strtoupper( $dto->EnrollmentInstallment_CCI, "utf-8" ) ),
				"EnrollmentInstallment_Remark"	=> trim( mb_strtoupper( $dto->EnrollmentInstallment_Remark, "utf-8" ) ),
				"EnrollmentInstallment_Default"	=> 1,
				"EnrollmentInstallment_Public"	=> $dto->EnrollmentInstallment_Public,
				"EnrollmentInstallment_Status"	=> $dto->EnrollmentInstallment_Status,
				"Id_School"				=> $dto->Id_School,
				"Id_TypeBank"			=> $dto->Id_TypeBank,
				"Id_TypeCurrency"		=> $dto->Id_TypeCurrency
			]);

			$oQuery->where("Id_EnrollmentInstallment", "=", "$Id");
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
	public function update(UpdateEnrollmentInstallmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->where("Id_EnrollmentInstallment", "=", $dto->Id_EnrollmentInstallment);
			$oQuery->update([
				"EnrollmentInstallment_Number"	=> trim( mb_strtoupper( $dto->EnrollmentInstallment_Number, "utf-8" ) ),
				"EnrollmentInstallment_CCI"		=> trim( mb_strtoupper( $dto->EnrollmentInstallment_CCI, "utf-8" ) ),
				"EnrollmentInstallment_Remark"	=> trim( mb_strtoupper( $dto->EnrollmentInstallment_Remark, "utf-8" ) ),
				"EnrollmentInstallment_Default"	=> 1,
				"EnrollmentInstallment_Public"	=> $dto->EnrollmentInstallment_Public,
				"EnrollmentInstallment_Status"	=> $dto->EnrollmentInstallment_Status,
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
	public function delete(int $Id_EnrollmentInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->where("Id_EnrollmentInstallment", "=", $Id_EnrollmentInstallment);
			$oQuery->update([
				"EnrollmentInstallment_Number"	=> DB::raw("CONCAT('( DELETED ) ', EnrollmentInstallment_Number)"),
				"EnrollmentInstallment_CCI"		=> DB::raw("CONCAT('( DELETED ) ', EnrollmentInstallment_CCI)"),
				"EnrollmentInstallment_Status"	=> 0
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
	public function index(int $Id_EnrollmentInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_EnrollmentInstallment", "=", $Id_EnrollmentInstallment);
			$oQuery->where("EnrollmentInstallment_Status", "<>", "0");

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
	public function list(int $Id_School, EnrollmentInstallmentFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
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
				EnrollmentInstallmentFilterDisplay::PUBLIC->value  => 2,
				EnrollmentInstallmentFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('EnrollmentInstallment_Public', $whereDisplay[$Display->value]);
			}

			$oQuery->where('EnrollmentInstallment_Status', '=', EnrollmentInstallmentStatus::ACTIVE->value);
			$oQuery->orderBy("EnrollmentInstallment_Default", "DESC");
			$oQuery->orderBy("Id_EnrollmentInstallment", "DESC");

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
	public function search(int $Id_School, SearchEnrollmentInstallmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
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
				EnrollmentInstallmentFilterDisplay::PUBLIC->value  => 2,
				EnrollmentInstallmentFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				EnrollmentInstallmentFilterStatus::ACTIVE->value   => 2,
				EnrollmentInstallmentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->join("t_type_bank", "t_school_account.Id_TypeBank", "=", "t_type_bank.Id_TypeBank");
			$oQuery->join("t_type_currency", "t_school_account.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->where("Id_School", "=", $Id_School);

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('EnrollmentInstallment_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('EnrollmentInstallment_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('EnrollmentInstallment_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("EnrollmentInstallment_Number", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("EnrollmentInstallment_CCI", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("EnrollmentInstallment_Remark", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeBank_Name", 			"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("EnrollmentInstallment_Default", "DESC");
			$oQuery->orderBy("Id_EnrollmentInstallment", "DESC");
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
