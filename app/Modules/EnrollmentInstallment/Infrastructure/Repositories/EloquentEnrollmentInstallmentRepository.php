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

use App\Modules\EnrollmentInstallment\Domain\Enums\EnrollmentInstallmentFilterPaid;
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
			$oQuery->where("EnrollmentInstallment_Order", "=", $dto->EnrollmentInstallment_Order);
			$oQuery->where("Id_Enrollment", "=", $dto->Id_Enrollment);
			$oQuery->where("Id_TypeCurrency", "=", $dto->Id_TypeCurrency);
			$oQuery->where("Id_TypeInstallment", "=", $dto->Id_TypeInstallment);

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
	public function canUpdate(int $Id_EnrollmentInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oResult	= [];
		$oData		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->where("Id_EnrollmentInstallment", "=", $Id_EnrollmentInstallment);
			$oQuery->where("EnrollmentInstallment_Paid", "=", "1");
			$oQuery->where("EnrollmentInstallment_Status", "=", "1");

			$oData = $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
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
	public function canPay(int $Id_EnrollmentInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oResult	= [];
		$oData		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->where("Id_EnrollmentInstallment", "=", $Id_EnrollmentInstallment);
			$oQuery->where("EnrollmentInstallment_Paid", "=", "1");
			$oQuery->where("EnrollmentInstallment_Status", "=", "2");

			$oData = $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
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
	public function canNullify(int $Id_EnrollmentInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentInstallmentModel::getEntity();
		$oResult	= [];
		$oData		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->where("Id_EnrollmentInstallment", "=", $Id_EnrollmentInstallment);
			$oQuery->where("EnrollmentInstallment_Paid", "=", "1");
			$oQuery->where("EnrollmentInstallment_Status", "=", "2");

			$oData = $oQuery->count();


			//
			//	FUNCTION
			//
			if ($oData == 1) {
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
				"Id_EnrollmentInstallment"					=> $dto->Id_EnrollmentInstallment,
				"EnrollmentInstallment_Date_Created"		=> date("Y-m-d H:i:s"),
				"EnrollmentInstallment_Date_Paid"			=> date("Y-m-d H:i:s"),
				"EnrollmentInstallment_Date_Nullified"		=> date("Y-m-d H:i:s"),
				"EnrollmentInstallment_Order"				=> $dto->EnrollmentInstallment_Order,
				"EnrollmentInstallment_Description"			=> trim( mb_strtoupper( $dto->EnrollmentInstallment_Description, "utf-8" ) ),
				"EnrollmentInstallment_Amount_Budgeted"		=> $dto->EnrollmentInstallment_Amount_Budgeted,
				"EnrollmentInstallment_Amount_Discounted"	=> $dto->EnrollmentInstallment_Amount_Discounted,
				"EnrollmentInstallment_Amount_Payabled"		=> $dto->EnrollmentInstallment_Amount_Payabled,
				"EnrollmentInstallment_Date_Collection"		=> $dto->EnrollmentInstallment_Date_Collection,
				"EnrollmentInstallment_Date_Due"			=> $dto->EnrollmentInstallment_Date_Due,
				"EnrollmentInstallment_Required"			=> $dto->EnrollmentInstallment_Required,
				"EnrollmentInstallment_Paid"				=> 1,
				"EnrollmentInstallment_Status"				=> 2,
				"Id_Charge"									=> 0,
				"Id_Enrollment"								=> $dto->Id_Enrollment,
				"Id_TypeCurrency"							=> $dto->Id_TypeCurrency,
				"Id_TypeInstallment"						=> $dto->Id_TypeInstallment
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
				"EnrollmentInstallment_Description"			=> trim( mb_strtoupper( $dto->EnrollmentInstallment_Description, "utf-8" ) ),
				"EnrollmentInstallment_Amount_Budgeted"		=> $dto->EnrollmentInstallment_Amount_Budgeted,
				"EnrollmentInstallment_Amount_Discounted"	=> $dto->EnrollmentInstallment_Amount_Discounted,
				"EnrollmentInstallment_Amount_Payabled"		=> $dto->EnrollmentInstallment_Amount_Payabled,
				"EnrollmentInstallment_Date_Collection"		=> $dto->EnrollmentInstallment_Date_Collection,
				"EnrollmentInstallment_Date_Due"			=> $dto->EnrollmentInstallment_Date_Due,
				"EnrollmentInstallment_Required"			=> $dto->EnrollmentInstallment_Required,
				"Id_Enrollment"								=> $dto->Id_Enrollment,
				"Id_TypeCurrency"							=> $dto->Id_TypeCurrency,
				"Id_TypeInstallment"						=> $dto->Id_TypeInstallment
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

			$oQuery->join("t_type_currency", "t_enrollment_installment.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_installment", "t_enrollment_installment.Id_TypeInstallment", "=", "t_type_installment.Id_TypeInstallment");
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
	public function list(int $Id_Enrollment, EnrollmentInstallmentFilterPaid $Display): Result
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
			$wherePaid	= [
				EnrollmentInstallmentFilterPaid::PAID->value  => 2,
				EnrollmentInstallmentFilterPaid::PENDING->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->join("t_type_currency", "t_enrollment_installment.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_installment", "t_enrollment_installment.Id_TypeInstallment", "=", "t_type_installment.Id_TypeInstallment");
			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);

			if (isset($wherePaid[$Display->value])) {
				$oQuery->where('EnrollmentInstallment_Paid', $wherePaid[$Display->value]);
			}

			$oQuery->where('EnrollmentInstallment_Status', '=', EnrollmentInstallmentStatus::ACTIVE->value);
			$oQuery->orderBy("EnrollmentInstallment_Order", "ASC");

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
	public function search(int $Id_Enrollment, SearchEnrollmentInstallmentDTO $dto): Result
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

			$wherePaid	= [
				EnrollmentInstallmentFilterPaid::PAID->value  => 2,
				EnrollmentInstallmentFilterPaid::PENDING->value => 1
			];
			$whereStatus	= [
				EnrollmentInstallmentFilterStatus::ACTIVE->value   => 2,
				EnrollmentInstallmentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentInstallmentModel::query();

			$oQuery->join("t_type_currency", "t_enrollment_installment.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_installment", "t_enrollment_installment.Id_TypeInstallment", "=", "t_type_installment.Id_TypeInstallment");
			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);

			if (isset($wherePaid[$dto->Paid->value])) {
				$oQuery->where('EnrollmentInstallment_Paid', $wherePaid[$dto->Paid->value]);
			} else {
				$oQuery->where('EnrollmentInstallment_Paid', '<>', 0);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('EnrollmentInstallment_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('EnrollmentInstallment_Status', '<>', 0);
			}

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("EnrollmentInstallment_Order", "ASC");
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
	public function pay(int $Id_EnrollmentInstallment): Result
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

			$oQuery->where("Id_EnrollmentInstallment", "=", $Id_EnrollmentInstallment);
			$oQuery->update([
				"EnrollmentInstallment_Date_Paid"	=> date("Y-m-d H:i:s"),
				"EnrollmentInstallment_Paid"		=> 2
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
	public function nullify(int $Id_EnrollmentInstallment): Result
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

			$oQuery->where("Id_EnrollmentInstallment", "=", $Id_EnrollmentInstallment);
			$oQuery->update([
				"EnrollmentInstallment_Date_Nullified"	=> date("Y-m-d H:i:s"),
				"EnrollmentInstallment_Status"			=> 9
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
	public function nullifyByEnrollment(int $Id_Enrollment): Result
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

			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->where("EnrollmentInstallment_Paid ", "=", 1);
			$oQuery->update([
				"EnrollmentInstallment_Date_Nullified"	=> date("Y-m-d H:i:s"),
				"EnrollmentInstallment_Status"			=> 9
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
}
