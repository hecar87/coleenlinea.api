<?php

namespace App\Application\TypeSchool\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeSchool\Repositories\ITypeSchoolRepository;


class DeleteTypeSchoolAction
{
	protected ITypeSchoolRepository $oTypeSchoolRepository;

	public function __construct(ITypeSchoolRepository $oTypeSchoolRepository)
	{
		$this->oTypeSchoolRepository = $oTypeSchoolRepository;
	}

	public function execute(int $Id_TypeSchool) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeSchoolRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeSchoolRepository->exists($Id_TypeSchool);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeSchoolRepository->delete($Id_TypeSchool);
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