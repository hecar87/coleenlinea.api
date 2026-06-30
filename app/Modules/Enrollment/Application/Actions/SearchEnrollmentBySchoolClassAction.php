<?php

namespace App\Modules\Enrollment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\SchoolClass\Domain\Repositories\ISchoolClassRepository;

use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentBySchoolClassDTO;


class SearchEnrollmentBySchoolClassAction
{

	public function __construct(
		protected IEnrollmentRepository $oEnrollmentRepository,
		protected ISchoolClassRepository $oSchoolClassRepository
	)
	{
	}

	public function execute(int $Id_SchoolClass, SearchEnrollmentBySchoolClassDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oEnrollmentRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oresult = $this->oSchoolClassRepository->exists($Id_SchoolClass);
			if ( $oresult->RESULT_STS <> 200 ){ DB::rollBack(); return $oresult; }

			$oResult = $this->oEnrollmentRepository->searchBySchoolClass($Id_SchoolClass, $oData);
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