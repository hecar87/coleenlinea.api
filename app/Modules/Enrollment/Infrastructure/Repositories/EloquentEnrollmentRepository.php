<?php

namespace App\Modules\Enrollment\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\Enrollment\Infrastructure\Persistence\EloquentEnrollment as EnrollmentModel;

use App\Modules\Enrollment\Application\DTOs\CreateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\UpdateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\DuplicatedEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentBySchoolClassDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentBySchoolYearDTO;
use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentByStudentDTO;

use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterNewed;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterStatus;
use App\Modules\Enrollment\Domain\Enums\EnrollmentFilterType;
use App\Modules\Enrollment\Domain\Enums\EnrollmentNewed;
use App\Modules\Enrollment\Domain\Enums\EnrollmentStatus;
use App\Modules\Enrollment\Domain\Enums\EnrollmentType;


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
			$oQuery->where("Id_SchoolYear", "=", $dto->Id_SchoolYear);
			$oQuery->where("Id_SchoolClass", "=", $dto->Id_SchoolClass);
			$oQuery->where("Id_Student", "=", $dto->Id_Student);

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
	public function canUpdate(int $Id_Enrollment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oResult	= [];
		$oData		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->where("Enrollment_Status", "=", "1");

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
	public function canEnroll(int $Id_Enrollment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oResult	= [];
		$oData		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->where("Enrollment_Status", "=", "1");

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
	public function canNullify(int $Id_Enrollment): Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity	= EnrollmentModel::getEntity();
		$oResult	= [];
		$oData		= 0;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try {
			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->where("Enrollment_Status", "=", "2");

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
	public function create(CreateEnrollmentDTO $dto, string $Date_Start, string $Date_End): Result
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

			$pEnrollment_Code = $this->generateCode();

			$Id 	= $oQuery->insertGetId([
				"Id_Enrollment"					=> $dto->Id_Enrollment,
				"Enrollment_Date_Created"		=> date("Y-m-d H:i:s"),
				"Enrollment_Date_Enrolled"		=> date("Y-m-d H:i:s"),
				"Enrollment_Date_Nullified"		=> date("Y-m-d H:i:s"),
				"Enrollment_Date_Start"			=> $Date_Start,
				"Enrollment_Date_End"			=> $Date_End,
				"Enrollment_Code"				=> $pEnrollment_Code,
				"Enrollment_Type"				=> $dto->Enrollment_Type,
				"Enrollment_Newed"				=> $dto->Enrollment_Newed,
				"Enrollment_Status"				=> 1,
				"Id_School"						=> $dto->Id_School,
				"Id_SchoolYear"					=> $dto->Id_SchoolYear,
				"Id_SchoolClass"				=> $dto->Id_SchoolClass,
				"Id_Student"					=> $dto->Id_Student
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
				"Enrollment_Type" 	=> $dto->Enrollment_Type,
				"Enrollment_Newed" 	=> $dto->Enrollment_Newed,
				"Id_School" 		=> $dto->Id_School,
				"Id_SchoolYear" 	=> $dto->Id_SchoolYear,
				"Id_SchoolClass" 	=> $dto->Id_SchoolClass,
				"Id_Student" 		=> $dto->Id_Student
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
				"Enrollment_Code"	=> DB::raw("CONCAT('( DELETED ) ', Enrollment_Code)"),
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

			$oQuery->join("t_school", "t_enrollment.Id_School ", "=", "t_school.Id_School ");
			$oQuery->join("t_school_year", "t_enrollment.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_class", "t_enrollment.Id_SchoolClass", "=", "t_school_class.Id_SchoolClass");
			$oQuery->join("t_student", "t_enrollment.Id_Student", "=", "t_student.Id_Student");
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
	public function listBySchoolClass(int $Id_SchoolClass): Result
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


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->join("t_school", "t_enrollment.Id_School ", "=", "t_school.Id_School ");
			$oQuery->join("t_school_year", "t_enrollment.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_class", "t_enrollment.Id_SchoolClass", "=", "t_school_class.Id_SchoolClass");
			$oQuery->join("t_student", "t_enrollment.Id_Student", "=", "t_student.Id_Student");
			$oQuery->where("Id_SchoolClass", "=", $Id_SchoolClass);
			$oQuery->where('Enrollment_Status', '=', EnrollmentStatus::ACTIVE->value);
			$oQuery->orderBy("Enrollment_Date_Start", "DESC");
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
	public function listByStudent(int $Id_Student): Result
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


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->join("t_school", "t_enrollment.Id_School ", "=", "t_school.Id_School ");
			$oQuery->join("t_school_year", "t_enrollment.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_class", "t_enrollment.Id_SchoolClass", "=", "t_school_class.Id_SchoolClass");
			$oQuery->join("t_student", "t_enrollment.Id_Student", "=", "t_student.Id_Student");
			$oQuery->where("Id_Student", "=", $Id_Student);
			$oQuery->where('Enrollment_Status', '=', EnrollmentStatus::ACTIVE->value);
			$oQuery->orderBy("Enrollment_Date_Start", "DESC");

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
	public function searchBySchoolClass(int $Id_SchoolClass, SearchEnrollmentBySchoolClassDTO $dto): Result
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

			$whereType	= [
				EnrollmentFilterType::PROMOTED->value  => 2,
				EnrollmentFilterType::REPEATER->value => 1
			];
			$whereNewed	= [
				EnrollmentFilterNewed::NEWED->value  => 2,
				EnrollmentFilterNewed::REGULAR->value => 1
			];
			$whereStatus	= [
				EnrollmentFilterStatus::ACTIVE->value   => 2,
				EnrollmentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->join("t_school", "t_enrollment.Id_School ", "=", "t_school.Id_School ");
			$oQuery->join("t_school_year", "t_enrollment.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_class", "t_enrollment.Id_SchoolClass", "=", "t_school_class.Id_SchoolClass");
			$oQuery->join("t_student", "t_enrollment.Id_Student", "=", "t_student.Id_Student");
			$oQuery->join("t_school_level", "t_school_class.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
			$oQuery->where("Id_SchoolClass", "=", $Id_SchoolClass);

			if (isset($whereType[$dto->Type->value])) {
				$oQuery->where('Enrollment_Type', $whereType[$dto->Type->value]);
			} else {
				$oQuery->where('Enrollment_Type', '<>', 0);
			}

			if (isset($whereNewed[$dto->Newed->value])) {
				$oQuery->where('Enrollment_Newed', $whereNewed[$dto->Newed->value]);
			} else {
				$oQuery->where('Enrollment_Newed', '<>', 0);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Enrollment_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Enrollment_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->orWhere	("Student_Code", 			"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_Name", 			"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_LastName", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_NoDocument", 		"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Enrollment_Date_Start", "DESC");
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
	public function searchBySchoolYear(int $Id_SchoolYear, SearchEnrollmentBySchoolYearDTO $dto): Result
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

			$whereType	= [
				EnrollmentFilterType::PROMOTED->value  => 2,
				EnrollmentFilterType::REPEATER->value => 1
			];
			$whereNewed	= [
				EnrollmentFilterNewed::NEWED->value  => 2,
				EnrollmentFilterNewed::REGULAR->value => 1
			];
			$whereStatus	= [
				EnrollmentFilterStatus::ACTIVE->value   => 2,
				EnrollmentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->join("t_school", "t_enrollment.Id_School ", "=", "t_school.Id_School ");
			$oQuery->join("t_school_year", "t_enrollment.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_class", "t_enrollment.Id_SchoolClass", "=", "t_school_class.Id_SchoolClass");
			$oQuery->join("t_student", "t_enrollment.Id_Student", "=", "t_student.Id_Student");
			$oQuery->join("t_school_level", "t_school_class.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
			$oQuery->where("Id_SchoolYear", "=", $Id_SchoolYear);

			if (isset($whereType[$dto->Type->value])) {
				$oQuery->where('Enrollment_Type', $whereType[$dto->Type->value]);
			} else {
				$oQuery->where('Enrollment_Type', '<>', 0);
			}

			if (isset($whereNewed[$dto->Newed->value])) {
				$oQuery->where('Enrollment_Newed', $whereNewed[$dto->Newed->value]);
			} else {
				$oQuery->where('Enrollment_Newed', '<>', 0);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Enrollment_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Enrollment_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->orWhere	("SchoolClass_Name", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolClass_Section", 	"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_Code", 			"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_Name", 			"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_LastName", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("Student_NoDocument", 		"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Enrollment_Date_Start", "DESC");
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
	public function searchByStudent(int $Id_Student, SearchEnrollmentByStudentDTO $dto): Result
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

			$whereType	= [
				EnrollmentFilterType::PROMOTED->value  => 2,
				EnrollmentFilterType::REPEATER->value => 1
			];
			$whereNewed	= [
				EnrollmentFilterNewed::NEWED->value  => 2,
				EnrollmentFilterNewed::REGULAR->value => 1
			];
			$whereStatus	= [
				EnrollmentFilterStatus::ACTIVE->value   => 2,
				EnrollmentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= EnrollmentModel::query();

			$oQuery->join("t_school", "t_enrollment.Id_School ", "=", "t_school.Id_School ");
			$oQuery->join("t_school_year", "t_enrollment.Id_SchoolYear", "=", "t_school_year.Id_SchoolYear");
			$oQuery->join("t_school_class", "t_enrollment.Id_SchoolClass", "=", "t_school_class.Id_SchoolClass");
			$oQuery->join("t_student", "t_enrollment.Id_Student", "=", "t_student.Id_Student");
			$oQuery->join("t_school_level", "t_school_class.Id_SchoolLevel", "=", "t_school_level.Id_SchoolLevel");
			$oQuery->where("Id_Student", "=", $Id_Student);

			if (isset($whereType[$dto->Type->value])) {
				$oQuery->where('Enrollment_Type', $whereType[$dto->Type->value]);
			} else {
				$oQuery->where('Enrollment_Type', '<>', 0);
			}

			if (isset($whereNewed[$dto->Newed->value])) {
				$oQuery->where('Enrollment_Newed', $whereNewed[$dto->Newed->value]);
			} else {
				$oQuery->where('Enrollment_Newed', '<>', 0);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Enrollment_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Enrollment_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->orWhere	("SchoolClass_Name", 		"LIKE", "%".$dto->Text."%");
				$oSubQuery->orWhere	("SchoolClass_Section", 	"LIKE", "%".$dto->Text."%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Enrollment_Date_Start", "DESC");
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
	public function enroll(int $Id_Enrollment): Result
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

			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->update([
				"Enrollment_Date_Enrolled"	=> date("Y-m-d H:i:s"),
				"Enrollment_Status"			=> 2
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
	public function nullify(int $Id_Enrollment): Result
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

			$oQuery->where("Id_Enrollment", "=", $Id_Enrollment);
			$oQuery->update([
				"Enrollment_Date_Nullified"	=> date("Y-m-d H:i:s"),
				"Enrollment_Status"			=> 9
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



	private function generateCode(): string
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
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
