<?php

namespace App\Application\TypeCivil\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeCivil\Repositories\ITypeCivilRepository;
use App\Domain\TypeCivil\Enums\TypeCivilFilterDisplay;


class ListTypeCivilAction
{
	protected ITypeCivilRepository $oTypeCivilRepository;

	public function __construct(ITypeCivilRepository $oTypeCivilRepository)
	{
		$this->oTypeCivilRepository = $oTypeCivilRepository;
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeCivilRepository->getEntity();
		$oDisplay 	= TypeCivilFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeCivilRepository->list($oDisplay);
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