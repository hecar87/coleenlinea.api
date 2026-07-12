<?php

namespace App\Modules\EnrollmentInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\EnrollmentInstallment\Domain\Repositories\IEnrollmentInstallmentRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;

use App\Modules\EnrollmentInstallment\Application\DTOs\SearchEnrollmentInstallmentDTO;


class SearchEnrollmentInstallmentAction
{

	public function __construct(
		protected IEnrollmentInstallmentRepository $oEnrollmentInstallmentRepository,
		protected ISchoolRepository $oSchoolRepository
	)
	{
	}

	public function execute(int $Id_School, SearchEnrollmentInstallmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oEnrollmentInstallmentRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oresult = $this->oSchoolRepository->exists($Id_School);
			if ( $oresult->RESULT_STS <> 200 ){ DB::rollBack(); return $oresult; }

			$oResult = $this->oEnrollmentInstallmentRepository->search($Id_School, $oData);
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