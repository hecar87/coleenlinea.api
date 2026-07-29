<?php

namespace App\Modules\Charge\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\Charge\Domain\Repositories\IChargeRepository;
use App\Modules\State\Domain\Repositories\IStateRepository;
use App\Modules\City\Domain\Repositories\ICityRepository;
use App\Modules\District\Domain\Repositories\IDistrictRepository;
use App\Modules\TypeDocument\Domain\Repositories\ITypeDocumentRepository;
use App\Modules\TypePopulation\Domain\Repositories\ITypePopulationRepository;
use App\Modules\TypeCharge\Domain\Repositories\ITypeChargeRepository;

use App\Modules\Charge\Application\DTOs\UpdateChargeDTO;
use App\Modules\Charge\Application\DTOs\DuplicatedChargeDTO;


class UpdateChargeAction
{

	public function __construct(
		protected IChargeRepository $oChargeRepository,
		protected IStateRepository $oStateRepository,
		protected ICityRepository $oCityRepository,
		protected IDistrictRepository $oDistrictRepository,
		protected ITypeDocumentRepository $oTypeDocumentRepository,
		protected ITypePopulationRepository $oTypePopulationRepository,
		protected ITypeChargeRepository $oTypeChargeRepository
	)
	{
	}

	public function execute(UpdateChargeDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oChargeRepository->getEntity();
		$oDataDuplicated = new DuplicatedChargeDTO(
			Id_Charge : $oData->Id_Charge,
			Charge_NoDocument : $oData->Charge_NoDocument,
			Id_TypeDocument : $oData->Id_TypeDocument
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

			$oResult = $this->oStateRepository->exists($oData->Id_State);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oCityRepository->exists($oData->Id_City);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oDistrictRepository->exists($oData->Id_District);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oTypeDocumentRepository->exists($oData->Id_TypeDocument);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oTypePopulationRepository->exists($oData->Id_TypePopulation);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }

			$oResult = $this->oTypeChargeRepository->exists($oData->Id_TypeCharge);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }


			$oResult = $this->oChargeRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oChargeRepository->update($oData);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			DB::commit();
		}
		catch (\Throwable $oException)
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