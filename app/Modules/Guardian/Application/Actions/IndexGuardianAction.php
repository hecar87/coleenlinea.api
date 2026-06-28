<?php

namespace App\Modules\School\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\School\Domain\Repositories\ISchoolRepository;


class IndexSchoolAction
{

	public function __construct(
		protected ISchoolRepository $oSchoolRepository
	)
	{
	}

	public function execute(int $Id_School) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oSchoolRepository->exists($Id_School);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolRepository->index($Id_School);
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