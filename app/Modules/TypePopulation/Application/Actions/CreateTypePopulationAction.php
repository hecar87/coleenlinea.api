<?php

namespace App\Modules\TypePopulation\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypePopulation\Domain\Repositories\ITypePopulationRepository;
use App\Modules\TypePopulation\Application\DTOs\CreateTypePopulationDTO;
use App\Modules\TypePopulation\Application\DTOs\DuplicatedTypePopulationDTO;


class CreateTypePopulationAction
{

	public function __construct(
		protected ITypePopulationRepository $oTypePopulationRepository
	)
	{
	}

	public function execute(CreateTypePopulationDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypePopulationRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypePopulationDTO(
			Id_TypePopulation	: 0,
			TypePopulation_Name	: $oData->TypePopulation_Name,
			TypePopulation_Abrv	: $oData->TypePopulation_Abrv
		);


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

			$oResult = $this->oTypePopulationRepository->create($oData);
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