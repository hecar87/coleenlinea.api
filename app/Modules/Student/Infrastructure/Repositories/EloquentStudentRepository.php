<?php

namespace App\Modules\Student\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Student\Domain\Repositories\IStudentRepository;
use App\Modules\Student\Infrastructure\Persistence\EloquentStudent as StudentModel;

use App\Modules\Student\Application\DTOs\CreateStudentDTO;
use App\Modules\Student\Application\DTOs\UpdateStudentDTO;
use App\Modules\Student\Application\DTOs\DuplicatedStudentDTO;
use App\Modules\Student\Application\DTOs\SearchStudentDTO;

use App\Modules\Student\Domain\Enums\StudentFilterVerified;
use App\Modules\Student\Domain\Enums\StudentFilterStatus;
use App\Modules\Student\Domain\Enums\StudentVerified;
use App\Modules\Student\Domain\Enums\StudentStatus;


class EloquentStudentRepository implements IStudentRepository
{
	public function getEntity(): string
	{
		return StudentModel::getEntity();
	}

	public function exists(int $Id_Student): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
		$oResult	= [];
		$exists		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$oQuery->where("Id_Student", "=", $Id_Student);
			$oQuery->where("Student_Status", "<>", "0");

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
	public function duplicated(DuplicatedStudentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
		$oResult	= [];
		$Duplicate	= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$oQuery->where("Id_Student", "<>", $dto->Id_Student);
			$oQuery->where("Student_Status", "<>", "0");
			$oQuery->where("Student_NoDocument", "=", $dto->Student_NoDocument);
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
	public function create(CreateStudentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$pStudent_Code = $this->generateCode();

			$Id 	= $oQuery->insertGetId([
				"Id_Student"				=> $dto->Id_Student,
				"Student_Date_Created"		=> date("Y-m-d H:i:s"),
				"Student_Date_Updated"		=> date("Y-m-d H:i:s"),
				"Student_Date_Deleted"		=> date("Y-m-d H:i:s"),
				"Student_Date_Verified"	=> date("Y-m-d H:i:s"),
				"Student_Code"				=> $pStudent_Code,
				"Student_Name"				=> trim( mb_strtoupper( $dto->Student_Name, "utf-8" ) ),
				"Student_LastName"			=> trim( mb_strtoupper( $dto->Student_LastName, "utf-8" ) ),
				"Student_NoDocument"		=> trim( mb_strtoupper( $dto->Student_NoDocument, "utf-8" ) ),
				"Student_DOB"				=> $dto->Student_DOB,
				"Student_Verified"			=> 1,
				"Student_Status"			=> 2,
				"Id_TypeDocument"			=> $dto->Id_TypeDocument,
				"Id_TypeGender"				=> $dto->Id_TypeGender
			]);

			$oQuery->where("Id_Student", "=", "$Id");
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
	public function update(UpdateStudentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//´
			$oQuery	= StudentModel::query();

			$oQuery->where("Id_Student", "=", $dto->Id_Student);
			$oQuery->update([
				"Student_Date_Updated"		=> date("Y-m-d H:i:s"),
				"Student_Name"				=> trim( mb_strtoupper( $dto->Student_Name, "utf-8" ) ),
				"Student_LastName"			=> trim( mb_strtoupper( $dto->Student_LastName, "utf-8" ) ),
				"Student_NoDocument"		=> trim( mb_strtoupper( $dto->Student_NoDocument, "utf-8" ) ),
				"Student_DOB"				=> $dto->Student_DOB,
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
	public function delete(int $Id_Student): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$oQuery->where("Id_Student", "=", $Id_Student);
			$oQuery->update([
				"Student_Code"	=> DB::raw("CONCAT('( DELETED ) ', Student_Code)"),
				"Student_Status"	=> 0
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
	public function index(int $Id_Student): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
		$oData		= [];
		$oResult	= [];


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$oQuery->join("t_type_document", "t_guardian.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_gender", "t_guardian.Id_TypeGender", "=", "t_type_gender.Id_TypeGender");
			$oQuery->where("Id_Student", "=", $Id_Student);
			$oQuery->where("Student_Status", "<>", "0");

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
	public function list(StudentFilterVerified $Display): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
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
				StudentFilterVerified::VERIFIED->value  => 2,
				StudentFilterVerified::PENDING->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$oQuery->join("t_type_document", "t_guardian.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_gender", "t_guardian.Id_TypeGender", "=", "t_type_gender.Id_TypeGender");

			if (isset($whereVerified[$Display->value])) {
				$oQuery->where('Student_Verified', $whereVerified[$Display->value]);
			}

			$oQuery->where('Student_Status', '=', StudentStatus::ACTIVE->value);
			$oQuery->orderBy("Student_TradeName", "ASC");

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
	public function search(SearchStudentDTO $dto): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
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
				StudentFilterVerified::VERIFIED->value  => 2,
				StudentFilterVerified::PENDING->value => 1
			];
			$whereStatus	= [
				StudentFilterStatus::ACTIVE->value   => 2,
				StudentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$oQuery->join("t_type_document", "t_guardian.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_gender", "t_guardian.Id_TypeGender", "=", "t_type_gender.Id_TypeGender");

			if (isset($whereVerified[$dto->Verified->value])) {
				$oQuery->where('Student_Verified', $whereVerified[$dto->Verified->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Student_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Student_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Student_Name", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Student_LastName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Student_NoDocument", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Student_LastName", "ASC");
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


	private function generateCode(): string
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= StudentModel::getEntity();
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
