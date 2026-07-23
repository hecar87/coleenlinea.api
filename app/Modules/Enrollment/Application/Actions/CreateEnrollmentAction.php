<?php

namespace App\Modules\Enrollment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;
use App\Modules\SchoolClass\Domain\Repositories\ISchoolClassRepository;
use App\Modules\Student\Domain\Repositories\IStudentRepository;

use App\Modules\Enrollment\Application\DTOs\CreateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\DuplicatedEnrollmentDTO;


class CreateEnrollmentAction
{

	public function __construct(
		protected IEnrollmentRepository $oEnrollmentRepository,
		protected ISchoolRepository $oSchoolRepository,
		protected ISchoolYearRepository $oSchoolYearRepository,
		protected ISchoolClassRepository $oSchoolClassRepository,
		protected IStudentRepository $oStudentRepository
	)
	{
	}

	public function execute(CreateEnrollmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oEnrollmentRepository->getEntity();
		$oDataDuplicated = new DuplicatedEnrollmentDTO(
			Id_Enrollment		: $oData->Id_Enrollment,
			Id_School			: $oData->Id_School,
			Id_SchoolYear		: $oData->Id_SchoolYear,
			Id_SchoolClass		: $oData->Id_SchoolClass,
			Id_Student			: $oData->Id_Student
		);


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oSchoolRepository->exists($oData->Id_School);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolYearRepository->exists($oData->Id_SchoolYear);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolClassRepository->exists($oData->Id_SchoolClass);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oStudentRepository->exists($oData->Id_Student);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oSchoolYearRepository->index($oData->Id_SchoolYear);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oSchoolYear 	= $oResult->RESULT_DTA[0];
			$Date_Start 	= $oSchoolYear->SchoolYear_Date_Start;
			$Date_End		= $oSchoolYear->SchoolYear_Date_End;


			$oResult = $this->oEnrollmentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oEnrollmentRepository->create($oData, $Date_Start, $Date_End);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oEnrollment = $oResult->RESULT_DTA[0];

			$oResult = $this->oSchoolClassRepository->index($oData->Id_SchoolClass);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oSchoolClass = $oResult->RESULT_DTA[0];

			DB::commit();
		}
		catch (\Exception $oException)
		{
			DB::rollBack();
			$oResult 	= ResultManager::Result(2000, $oEntity, null, 0, $oException->getMessage());
		}


		//------------------------------------------------------------------------------
		//	RESPONSE
		//------------------------------------------------------------------------------
		return $oResult;

	}
}