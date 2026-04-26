<?php

namespace App\Application\TypeSchool\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeSchool\Repositories\ITypeSchoolRepository;
use App\Domain\TypeSchool\Enums\TypeSchoolFilterDisplay;


class ListTypeSchoolAction
{
	protected ITypeSchoolRepository $oTypeSchoolRepository;

	public function __construct(ITypeSchoolRepository $oTypeSchoolRepository)
	{
		$this->oTypeSchoolRepository = $oTypeSchoolRepository;
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeSchoolRepository->getEntity();
		$oDisplay 	= TypeSchoolFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeSchoolRepository->list($oDisplay);
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