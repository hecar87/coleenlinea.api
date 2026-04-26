<?php

namespace App\Application\TypePopulation\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypePopulation\Repositories\ITypePopulationRepository;
use App\Application\TypePopulation\DTOs\UpdateTypePopulationDTO;
use App\Application\TypePopulation\DTOs\DuplicatedTypePopulationDTO;


class UpdateTypePopulationAction
{
	protected ITypePopulationRepository $oTypePopulationRepository;

	public function __construct(ITypePopulationRepository $oTypePopulationRepository)
	{
		$this->oTypePopulationRepository = $oTypePopulationRepository;
	}

	public function execute(UpdateTypePopulationDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypePopulationRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypePopulationDTO(
			Id_TypePopulation	: $oData->Id_TypePopulation,
			TypePopulation_Name	: $oData->TypePopulation_Name,
			TypePopulation_Abrv	: $oData->TypePopulation_Abrv
		);;


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypePopulationRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypePopulationRepository->update($oData);
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