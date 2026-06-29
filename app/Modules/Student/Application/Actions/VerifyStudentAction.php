<?php

namespace App\Modules\Guardian\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;


class VerifyGuardianAction
{

	public function __construct(
		protected IGuardianRepository $oGuardianRepository
	)
	{
	}

	public function execute(int $Id_Guardian) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oGuardianRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oGuardianRepository->exists($Id_Guardian);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oGuardianRepository->canVerify($Id_Guardian);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oGuardianRepository->verify($Id_Guardian);
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