<?php

namespace App\Modules\SchoolInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;
use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;

use App\Modules\SchoolInstallment\Domain\Enums\SchoolInstallmentFilterDisplay;


class ListSchoolInstallmentAction
{

	public function __construct(
		protected ISchoolInstallmentRepository $oSchoolInstallmentRepository,
		protected ISchoolYearRepository $oSchoolYearRepository
	)
	{
	}

	public function execute(int $Id_SchoolYear, string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oSchoolInstallmentRepository->getEntity();
		$oDisplay 	= SchoolInstallmentFilterDisplay::from(strtoupper($Display));


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

			$oResult = $this->oSchoolInstallmentRepository->list($Id_SchoolYear, $oDisplay);
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