<?php

namespace App\Modules\SchoolProfile\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\SchoolProfile\Domain\Repositories\ISchoolProfileRepository;
use App\Modules\School\Domain\Repositories\ISchoolRepository;


class ListSchoolProfileAction
{

	public function __construct(
		protected ISchoolProfileRepository $oSchoolProfileRepository,
		protected ISchoolRepository $oSchoolRepository
	)
	{
	}

	public function execute(int $Id_School) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oSchoolProfileRepository->getEntity();


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

			$oResult = $this->oSchoolProfileRepository->list($Id_School);
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