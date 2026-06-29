<?php

namespace App\Modules\StudentGuardian\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\StudentGuardian\Domain\Repositories\IStudentGuardianRepository;
use App\Modules\Student\Domain\Repositories\IStudentRepository;

use App\Modules\StudentGuardian\Domain\Enums\StudentGuardianFilterVerified;


class ListStudentGuardianByStudentAction
{

	public function __construct(
		protected IStudentGuardianRepository $oStudentGuardianRepository,
		protected IStudentRepository $oStudentRepository
	)
	{
	}

	public function execute(int $Id_Student, string $Verified) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oStudentGuardianRepository->getEntity();
		$oVerified 	= StudentGuardianFilterVerified::from(strtoupper($Verified));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oresult = $this->oStudentRepository->exists($Id_Student);
			if ( $oresult->RESULT_STS <> 200 ){ DB::rollBack(); return $oresult; }

			$oResult = $this->oStudentGuardianRepository->listByStudent($Id_Student, $oVerified);
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