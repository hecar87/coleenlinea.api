<?php

namespace App\Modules\SchoolInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;
use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;


class ListSchoolInstallmentAction
{

	public function __construct(
		protected ISchoolInstallmentRepository $oSchoolInstallmentRepository,
		protected ISchoolProfileRepository $oSchoolProfileRepository
	)
	{
	}

	public function execute(int $Id_SchoolProfile) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oSchoolInstallmentRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oresult = $this->oSchoolProfileRepository->exists($Id_SchoolProfile);
			if ( $oresult->RESULT_STS <> 200 ){ DB::rollBack(); return $oresult; }

			$oResult = $this->oSchoolInstallmentRepository->list($Id_SchoolProfile);
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