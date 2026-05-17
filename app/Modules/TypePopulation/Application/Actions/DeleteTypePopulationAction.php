<?php

namespace App\Modules\TypePopulation\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypePopulation\Domain\Repositories\ITypePopulationRepository;


class DeleteTypePopulationAction
{
	protected ITypePopulationRepository $oTypePopulationRepository;

	public function __construct(ITypePopulationRepository $oTypePopulationRepository)
	{
		$this->oTypePopulationRepository = $oTypePopulationRepository;
	}

	public function execute(int $Id_TypePopulation) : Result
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

			$oResult = $this->oTypePopulationRepository->exists($Id_TypePopulation);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypePopulationRepository->delete($Id_TypePopulation);
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