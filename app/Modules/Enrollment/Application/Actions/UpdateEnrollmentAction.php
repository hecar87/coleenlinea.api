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

use App\Modules\Enrollment\Application\DTOs\UpdateEnrollmentDTO;
use App\Modules\Enrollment\Application\DTOs\DuplicatedEnrollmentDTO;


class UpdateEnrollmentAction
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

	public function execute(UpdateEnrollmentDTO $oData) : Result
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

			$oResult = $this->oEnrollmentRepository->exists($oData->Id_Enrollment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oEnrollmentRepository->canUpdate($oData->Id_Enrollment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }


			$oResult = $this->oEnrollmentRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oEnrollmentRepository->update($oData);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

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