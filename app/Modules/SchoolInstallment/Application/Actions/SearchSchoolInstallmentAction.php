<?php

namespace App\Modules\SchoolInstallment\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolInstallment\Domain\Repositories\ISchoolInstallmentRepository;
use App\Modules\SchoolYear\Domain\Repositories\ISchoolYearRepository;

use App\Modules\SchoolInstallment\Application\DTOs\SearchSchoolInstallmentDTO;


class SearchSchoolInstallmentAction
{

	public function __construct(
		protected ISchoolInstallmentRepository $oSchoolInstallmentRepository,
		protected ISchoolYearRepository $oSchoolYearRepository
	)
	{
	}

	public function execute(int $Id_SchoolYear, SearchSchoolInstallmentDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolInstallmentRepository->getEntity();


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

			$oResult = $this->oSchoolInstallmentRepository->search($Id_SchoolYear, $oData);
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