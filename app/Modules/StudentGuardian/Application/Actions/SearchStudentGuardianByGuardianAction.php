<?php

namespace App\Modules\StudentGuardian\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\StudentGuardian\Domain\Repositories\IStudentGuardianRepository;
use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;

use App\Modules\StudentGuardian\Application\DTOs\SearchStudentGuardianByGuardianDTO;


class SearchStudentGuardianByGuardianAction
{

	public function __construct(
		protected IStudentGuardianRepository $oStudentGuardianRepository,
		protected IGuardianRepository $oGuardianRepository
	)
	{
	}

	public function execute(int $Id_Guardian, SearchStudentGuardianByGuardianDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oStudentGuardianRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oresult = $this->oGuardianRepository->exists($Id_Guardian);
			if ( $oresult->RESULT_STS <> 200 ){ DB::rollBack(); return $oresult; }

			$oResult = $this->oStudentGuardianRepository->searchByGuardian($Id_Guardian, $oData);
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