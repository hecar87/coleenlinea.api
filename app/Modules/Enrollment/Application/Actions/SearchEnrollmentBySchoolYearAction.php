<?php

namespace App\Modules\Enrollment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Enrollment\Domain\Repositories\IEnrollmentRepository;
use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;

use App\Modules\Enrollment\Application\DTOs\SearchEnrollmentBySchoolYearDTO;


class SearchEnrollmentBySchoolYearAction
{

	public function __construct(
		protected IEnrollmentRepository $oEnrollmentRepository,
		protected ISchoolYearRepository $oSchoolYearRepository
	)
	{
	}

	public function execute(int $Id_SchoolYear, SearchEnrollmentBySchoolYearDTO $oData) : Result
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

			$oresult = $this->oSchoolYearRepository->exists($Id_SchoolYear);
			if ( $oresult->RESULT_STS <> 200 ){ DB::rollBack(); return $oresult; }

			$oResult = $this->oEnrollmentRepository->searchBySchoolYear($Id_SchoolYear, $oData);
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