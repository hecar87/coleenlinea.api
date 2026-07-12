<?php

namespace App\Modules\EnrollmentInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\EnrollmentInstallment\Domain\Repositories\IEnrollmentInstallmentRepository;


class IndexEnrollmentInstallmentAction
{

	public function __construct(
		protected IEnrollmentInstallmentRepository $oEnrollmentInstallmentRepository
	)
	{
	}

	public function execute(int $Id_EnrollmentInstallment) : Result
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

			$oResult = $this->oEnrollmentInstallmentRepository->exists($Id_EnrollmentInstallment);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oEnrollmentInstallmentRepository->index($Id_EnrollmentInstallment);
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