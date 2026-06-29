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
use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianByGuardianDTO;
use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianByStudentDTO;

use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterVerified;
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
			$oQuery->where("Id_Student", "=", $dto->Id_Student);
			$oQuery->where("Id_Guardian", "=", $dto->Id_Guardian);
			$oQuery->where("Id_TypeKinship", "=", $dto->Id_TypeKinship);

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
				"Id_StudentGuardian"			=> $dto->Id_StudentGuardian,
				"StudentGuardian_Date_Start"	=> date("Y-m-d H:i:s"),
				"StudentGuardian_Date_End"		=> date("Y-m-d H:i:s",  strtotime( "+12 months", strtotime( date( "Y-m-d H:i:s" ) ) ) ),
				"StudentGuardian_Verified"		=> 1,
				"StudentGuardian_Status"		=> 2,
				"Id_Student"					=> $dto->Id_Student,
				"Id_Guardian"					=> $dto->Id_Guardian,
				"Id_TypeKinship"				=> $dto->Id_TypeKinship
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
				"Id_Student"			=> $dto->Id_Student,
				"Id_Guardian"			=> $dto->Id_Guardian,
				"Id_TypeKinship"		=> $dto->Id_TypeKinship
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

			$oQuery->join("t_guardian", "t_student_guardian.Id_Guardian", "=", "t_guardian.Id_Guardian");
			$oQuery->join("t_student", "t_student_guardian.Id_Student", "=", "t_student.Id_Student");
			$oQuery->join("t_type_kinship", "t_student_guardian.Id_TypeKinship", "=", "t_type_kinship.Id_TypeKinship");
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
	public function listByGuardian(int $Id_Guardian, StudentGuardianFilterVerified $Verified): Result
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
			$whereVerified	= [
				StudentGuardianFilterVerified::VERIFIED->value  => 2,
				StudentGuardianFilterVerified::PENDING->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->join("t_student", "t_student_guardian.Id_Student", "=", "t_student.Id_Student");
			$oQuery->join("t_type_kinship", "t_student_guardian.Id_TypeKinship", "=", "t_type_kinship.Id_TypeKinship");
			$oQuery->where("Id_Guardian", "=", $Id_Guardian);

			if (isset($whereVerified[$Verified->value])) {
				$oQuery->where('StudentGuardian_Public', $whereVerified[$Verified->value]);
			}

			$oQuery->where('StudentGuardian_Status', '=', StudentGuardianStatus::ACTIVE->value);
			$oQuery->orderBy("Student_LastName", "ASC");
			$oQuery->orderBy("Student_Name", "ASC");

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
	public function listByStudent(int $Id_Student, StudentGuardianFilterVerified $Verified): Result
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
			$whereVerified	= [
				StudentGuardianFilterVerified::VERIFIED->value  => 2,
				StudentGuardianFilterVerified::PENDING->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->join("t_guardian", "t_student_guardian.Id_Guardian", "=", "t_guardian.Id_Guardian");
			$oQuery->join("t_type_kinship", "t_student_guardian.Id_TypeKinship", "=", "t_type_kinship.Id_TypeKinship");
			$oQuery->where("Id_Student", "=", $Id_Student);

			if (isset($whereVerified[$Verified->value])) {
				$oQuery->where('StudentGuardian_Public', $whereVerified[$Verified->value]);
			}

			$oQuery->where('StudentGuardian_Status', '=', StudentGuardianStatus::ACTIVE->value);
			$oQuery->orderBy("Guardian_LastName", "ASC");
			$oQuery->orderBy("Guardian_Name", "ASC");

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
	public function searchByGuardian(int $Id_Guardian, SearchStudentGuardianByGuardianDTO $dto): Result
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

			$whereVerified	= [
				StudentGuardianFilterVerified::VERIFIED->value  => 2,
				StudentGuardianFilterVerified::PENDING->value => 1
			];
			$whereStatus	= [
				StudentGuardianFilterStatus::ACTIVE->value   => 2,
				StudentGuardianFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->join("t_student", "t_student_guardian.Id_Student", "=", "t_student.Id_Student");
			$oQuery->join("t_type_kinship", "t_student_guardian.Id_TypeKinship", "=", "t_type_kinship.Id_TypeKinship");
			$oQuery->where("Id_Guardian", "=", $Id_Guardian);

			if (isset($whereVerified[$dto->Verified->value])) {
				$oQuery->where('StudentGuardian_Public', $whereVerified[$dto->Verified->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('StudentGuardian_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('StudentGuardian_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("Student_Code",		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_Name", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_LastName", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_NoDocument",	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Student_LastName", "ASC");
			$oQuery->orderBy("Student_Name", "ASC");
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
	public function searchByStudent(int $Id_Student, SearchStudentGuardianByStudentDTO $dto): Result
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

			$whereVerified	= [
				StudentGuardianFilterVerified::VERIFIED->value  => 2,
				StudentGuardianFilterVerified::PENDING->value => 1
			];
			$whereStatus	= [
				StudentGuardianFilterStatus::ACTIVE->value   => 2,
				StudentGuardianFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentGuardianModel::query();

			$oQuery->join("t_guardian", "t_student_guardian.Id_Guardian", "=", "t_guardian.Id_Guardian");
			$oQuery->join("t_type_kinship", "t_student_guardian.Id_TypeKinship", "=", "t_type_kinship.Id_TypeKinship");
			$oQuery->where("Id_Student", "=", $Id_Student);

			if (isset($whereVerified[$dto->Verified->value])) {
				$oQuery->where('StudentGuardian_Public', $whereVerified[$dto->Verified->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('StudentGuardian_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('StudentGuardian_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where	("Guardian_Code",		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Guardian_Name", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Guardian_LastName", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Guardian_NoDocument",	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Guardian_LastName", "ASC");
			$oQuery->orderBy("Guardian_Name", "ASC");
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
