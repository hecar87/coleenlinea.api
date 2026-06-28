<?php

namespace App\Modules\Student\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\PaginationManager;
use App\Helpers\ResultManager;
use App\Helpers\Result;

use App\Modules\Student\Domain\Repositories\IStudentRepository;
use App\Modules\Student\Infrastructure\Persistence\EloquentStudent as StudentModel;

use App\Modules\Student\Application\DTOs\CreateStudentDTO;
use App\Modules\Student\Application\DTOs\UpdateStudentDTO;
use App\Modules\Student\Application\DTOs\DuplicatedStudentDTO;
use App\Modules\Student\Application\DTOs\SearchStudentDTO;

use App\Modules\Student\Domain\Enums\StudentFilterDisplay;
use App\Modules\Student\Domain\Enums\StudentFilterStatus;
use App\Modules\Student\Domain\Enums\StudentPublic;
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

			$pStudent_Code = $this->generateCode($dto->Id_State, $dto->Id_City, $dto->Id_District, $dto->Id_TypeStudent);

			$Id 	= $oQuery->insertGetId([
				"Id_Student"				=> $dto->Id_Student,
				"Student_Code"			=> $pStudent_Code,
				"Student_BusinessName"	=> trim(mb_strtoupper($dto->Student_BusinessName, "utf-8" ) ),
				"Student_TradeName"		=> trim(mb_strtoupper($dto->Student_TradeName, "utf-8" ) ),
				"Student_NoDocument"		=> trim(mb_strtoupper($dto->Student_NoDocument, "utf-8" ) ),
				"Student_Address"		=> trim(mb_strtoupper($dto->Student_Address, "utf-8" ) ),
				"Student_Phone"			=> trim(mb_strtoupper($dto->Student_Phone, "utf-8" ) ),
				"Student_Public"			=> $dto->Student_Public,
				"Student_Status"			=> $dto->Student_Status,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District,
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"Id_TypeStudent"			=> $dto->Id_TypeStudent
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
				"Student_BusinessName"	=> trim(mb_strtoupper($dto->Student_BusinessName, "utf-8" ) ),
				"Student_TradeName"		=> trim(mb_strtoupper($dto->Student_TradeName, "utf-8" ) ),
				"Student_NoDocument"		=> trim(mb_strtoupper($dto->Student_NoDocument, "utf-8" ) ),
				"Student_Address"		=> trim(mb_strtoupper($dto->Student_Address, "utf-8" ) ),
				"Student_Phone"			=> trim(mb_strtoupper($dto->Student_Phone, "utf-8" ) ),
				"Student_Public"			=> $dto->Student_Public,
				"Student_Status"			=> $dto->Student_Status,
				"Id_State"				=> $dto->Id_State,
				"Id_City"				=> $dto->Id_City,
				"Id_District"			=> $dto->Id_District,
				"Id_TypeDocument"		=> $dto->Id_TypeDocument,
				"Id_TypePopulation"		=> $dto->Id_TypePopulation,
				"Id_TypeStudent"			=> $dto->Id_TypeStudent
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
				"Student_Name"	=> DB::raw("CONCAT('( DELETED ) ', Student_Name)"),
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

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeStudent", "=", "t_type_school.Id_TypeStudent");
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
	public function list(StudentFilterDisplay $Display): Result
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
			$whereDisplay	= [
				StudentFilterDisplay::PUBLIC->value  => 2,
				StudentFilterDisplay::PRIVATE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeStudent", "=", "t_type_school.Id_TypeStudent");

			if (isset($whereDisplay[$Display->value])) {
				$oQuery->where('Student_Public', $whereDisplay[$Display->value]);
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

			$whereDisplay	= [
				StudentFilterDisplay::PUBLIC->value  => 2,
				StudentFilterDisplay::PRIVATE->value => 1
			];
			$whereStatus	= [
				StudentFilterStatus::ACTIVE->value   => 2,
				StudentFilterStatus::INACTIVE->value => 1
			];


			//
			//	TRANSACTION
			//
			$oQuery	= StudentModel::query();

			$oQuery->join("t_state", "t_school.Id_State", "=", "t_state.Id_State");
			$oQuery->join("t_city", "t_school.Id_City", "=", "t_city.Id_City");
			$oQuery->join("t_district", "t_school.Id_District", "=", "t_district.Id_District");
			$oQuery->join("t_type_document", "t_school.Id_TypeDocument", "=", "t_type_document.Id_TypeDocument");
			$oQuery->join("t_type_population", "t_school.Id_TypePopulation", "=", "t_type_population.Id_TypePopulation");
			$oQuery->join("t_type_school", "t_school.Id_TypeStudent", "=", "t_type_school.Id_TypeStudent");

			if (isset($whereDisplay[$dto->Display->value])) {
				$oQuery->where('Student_Public', $whereDisplay[$dto->Display->value]);
			}

			if (isset($whereStatus[$dto->Status->value])) {
				$oQuery->where('Student_Status', $whereStatus[$dto->Status->value]);
			} else {
				$oQuery->where('Student_Status', '<>', 0);
			}

			$oQuery->where(function ($oSubQuery) use ($dto) {
				$oSubQuery->where("Student_Code", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Student_BusinessName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Student_TradeName", "LIKE", "%" . $dto->Text . "%");
				$oSubQuery->orWhere("Student_NoDocument", "LIKE", "%" . $dto->Text . "%");
			});

			// GET TOTAL DATA
			$Data_Total	= $oQuery->count();

			// SET PAGINATION
			$oQuery->orderBy("Student_TradeName", "ASC");
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


	private function generateCode(int $Id_State, int $Id_City, int $Id_District, int $Id_TypeStudent): string
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
			$oRow				= StudentModel::orderBy("Id_Student", "DESC")->get()->first();
			$New_Id				= $oRow == null ? 1 : $oRow->Id_Student + 1;

			$Code_Student		= str_pad( $New_Id, 6, "0", STR_PAD_LEFT );
			$Code_State			= str_pad( $Id_State, 2, "0", STR_PAD_LEFT );
			$Code_City			= str_pad( $Id_City, 3, "0", STR_PAD_LEFT );
			$Code_District		= str_pad( $Id_District, 4, "0", STR_PAD_LEFT );
			$Code_TypeStudent	= str_pad( $Id_TypeStudent, 2, "0", STR_PAD_LEFT );

			$oResult			= "SC".$Code_TypeStudent.$Code_State.$Code_City.$Code_District.$Code_Student;
		} catch (\Exception $oException) {
			$oResult = "ERCODE";
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;
	}
}
