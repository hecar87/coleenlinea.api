<?php

namespace App\Application\TypeLevel\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeLevel\Repositories\ITypeLevelRepository;
use App\Domain\TypeLevel\Enums\TypeLevelFilterDisplay;


class ListTypeLevelAction
{
	protected ITypeLevelRepository $oTypeLevelRepository;

	public function __construct(ITypeLevelRepository $oTypeLevelRepository)
	{
		$this->oTypeLevelRepository = $oTypeLevelRepository;
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeLevelRepository->getEntity();
		$oDisplay 	= TypeLevelFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeLevelRepository->list($oDisplay);
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