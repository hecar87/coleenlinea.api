<?php

namespace App\Application\TypePopulation\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypePopulation\Repositories\ITypePopulationRepository;
use App\Application\TypePopulation\DTOs\SearchTypePopulationDTO;

class SearchTypePopulationAction
{
	protected ITypePopulationRepository $oTypePopulationRepository;

	public function __construct(ITypePopulationRepository $oTypePopulationRepository)
	{
		$this->oTypePopulationRepository = $oTypePopulationRepository;
	}

	public function execute(SearchTypePopulationDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypePopulationRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypePopulationRepository->search($oData);
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