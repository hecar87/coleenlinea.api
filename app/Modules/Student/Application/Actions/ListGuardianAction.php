<?php

namespace App\Modules\Guardian\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Guardian\Domain\Repositories\IGuardianRepository;
use App\Modules\Guardian\Domain\Enums\GuardianFilterVerified;


class ListGuardianAction
{

	public function __construct(
		protected IGuardianRepository $oGuardianRepository
	)
	{
	}

	public function execute(string $Verified) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oGuardianRepository->getEntity();
		$oVerified 	= GuardianFilterVerified::from(strtoupper($Verified));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oGuardianRepository->list($oVerified);
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