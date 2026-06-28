<?php

namespace App\Modules\SchoolInstallment\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;
use App\Modules\SchoolInstallment\Infrastructure\Persistence\EloquentSchoolInstallment as SchoolInstallmentModel;

use App\Modules\SchoolInstallment\Application\DTOs\CreateSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\UpdateSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\DuplicatedSchoolInstallmentDTO;
use App\Modules\SchoolInstallment\Application\DTOs\SearchSchoolInstallmentDTO;

use App\Modules\SchoolInstallment\Domain\Enums\SchoolInstallmentFilterDisplay;
use App\Modules\SchoolInstallment\Domain\Enums\SchoolInstallmentFilterStatus;
use App\Modules\SchoolInstallment\Domain\Enums\SchoolInstallmentPublic;
use App\Modules\SchoolInstallment\Domain\Enums\SchoolInstallmentStatus;


class EloquentSchoolInstallmentRepository implements ISchoolInstallmentRepository
{
	public function getEntity(): string
	{
		return SchoolInstallmentModel::getEntity();
	}

	public function exists(int $Id_SchoolInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolInstallmentModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolInstallmentModel::query();

			$oQuery->where("Id_SchoolInstallment", "=", $Id_SchoolInstallment);
			$oQuery->where("SchoolInstallment_Status", "<>", "0");

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
	public function duplicated(DuplicatedSchoolInstallmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolInstallmentModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolInstallmentModel::query();

			$oQuery->where("Id_SchoolInstallment", "<>", $dto->Id_SchoolInstallment);
			$oQuery->where("SchoolInstallment_Status", "<>", "0");
			$oQuery->where("Id_SchoolYear", "=", $dto->Id_SchoolYear);
			$oQuery->where("Id_SchoolLevel", "=", $dto->Id_SchoolLevel);
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
	public function create(CreateSchoolInstallmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolInstallmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolInstallmentModel::query();

			$Id 	= $oQuery->insertGetId([
				"Id_SchoolInstallment"				=> $dto->Id_SchoolInstallment,
				"SchoolInstallment_Amount"			=> $dto->SchoolInstallment_Amount,
				"SchoolInstallment_Date_Start"		=> $dto->SchoolInstallment_Date_Start,
				"SchoolInstallment_Date_End"		=> $dto->SchoolInstallment_Date_End,
				"SchoolInstallment_Promoted"		=> $dto->SchoolInstallment_Promoted,
				"SchoolInstallment_Repeated"		=> $dto->SchoolInstallment_Repeated,
				"SchoolInstallment_Newed"			=> $dto->SchoolInstallment_Newed,
				"SchoolInstallment_Status"			=> $dto->SchoolInstallment_Status,
				"Id_SchoolYear"						=> $dto->Id_SchoolYear,
				"Id_SchoolLevel"					=> $dto->Id_SchoolLevel,
				"Id_TypeCurrency"					=> $dto->Id_TypeCurrency,
				"Id_TypeInstallment"				=> $dto->Id_TypeInstallment
			]);

			$oQuery->where("Id_SchoolInstallment", "=", "$Id");
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
	public function update(UpdateSchoolInstallmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolInstallmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= SchoolInstallmentModel::query();

			$oQuery->where("Id_SchoolInstallment", "=", $dto->Id_SchoolInstallment);
			$oQuery->update([
				"SchoolInstallment_Amount"			=> $dto->SchoolInstallment_Amount,
				"SchoolInstallment_Date_Start"		=> $dto->SchoolInstallment_Date_Start,
				"SchoolInstallment_Date_End"		=> $dto->SchoolInstallment_Date_End,
				"SchoolInstallment_Promoted"		=> $dto->SchoolInstallment_Promoted,
				"SchoolInstallment_Repeated"		=> $dto->SchoolInstallment_Repeated,
				"SchoolInstallment_Newed"			=> $dto->SchoolInstallment_Newed,
				"SchoolInstallment_Status"			=> $dto->SchoolInstallment_Status,
				"Id_SchoolYear"						=> $dto->Id_SchoolYear,
				"Id_SchoolLevel"					=> $dto->Id_SchoolLevel,
				"Id_TypeCurrency"					=> $dto->Id_TypeCurrency,
				"Id_TypeInstallment"				=> $dto->Id_TypeInstallment
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
	public function delete(int $Id_SchoolInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolInstallmentModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolInstallmentModel::query();

			$oQuery->where("Id_SchoolInstallment", "=", $Id_SchoolInstallment);
			$oQuery->update([
				"SchoolInstallment_Status"	=> 0
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
	public function index(int $Id_SchoolInstallment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolInstallmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= SchoolInstallmentModel::query();

			$oQuery->join("t_school_level", "t_school_installment.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
			$oQuery->join("t_type_currency", "t_school_installment.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_installment", "t_school_installment.Id_TypeInstallment", "=", "t_type_installment.Id_TypeInstallment");
			$oQuery->where("Id_SchoolInstallment", "=", $Id_SchoolInstallment);
			$oQuery->where("SchoolInstallment_Status", "<>", "0");

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
	public function list(int $Id_SchoolYear, SchoolInstallmentFilterDisplay $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolInstallmentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	SET VARIABLES
			//


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolInstallmentModel::query();

			$oQuery->join("t_school_level", "t_school_installment.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
			$oQuery->join("t_type_currency", "t_school_installment.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_installment", "t_school_installment.Id_TypeInstallment", "=", "t_type_installment.Id_TypeInstallment");
			$oQuery->where("Id_SchoolYear", "=", $Id_SchoolYear);
			$oQuery->where('SchoolInstallment_Status', '=', SchoolInstallmentStatus::ACTIVE->value);
			$oQuery->orderBy("SchoolInstallment_Date_Start", "DESC");

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
	public function search(int $Id_SchoolYear, SearchSchoolInstallmentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= SchoolInstallmentModel::getEntity();
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

			$whereStatus	= [
				SchoolInstallmentFilterStatus::ACTIVE->value   => 2,
				SchoolInstallmentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= SchoolInstallmentModel::query();

			$oQuery->join("t_school_level", "t_school_installment.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
			$oQuery->join("t_type_currency", "t_school_installment.Id_TypeCurrency", "=", "t_type_currency.Id_TypeCurrency");
			$oQuery->join("t_type_installment", "t_school_installment.Id_TypeInstallment", "=", "t_type_installment.Id_TypeInstallment");
			$oQuery->where("Id_SchoolYear", "=", $Id_SchoolYear);

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('SchoolInstallment_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('SchoolInstallment_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("SchoolLevel_Code", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->where	("TypeInstallment_Name", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("TypeInstallment_Abrv",	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("SchoolInstallment_Date_Start", "DESC");
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
