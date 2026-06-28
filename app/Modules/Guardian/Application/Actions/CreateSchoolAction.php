<?php

namespace App\Modules\School\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\School\Domain\Repositories\ISchoolRepository;
use App\Modules\State\Domain\Repositories\IStateRepository;
use App\Modules\City\Domain\Repositories\ICityRepository;
use App\Modules\District\Domain\Repositories\IDistrictRepository;
use App\Modules\TypeDocument\Domain\Repositories\ITypeDocumentRepository;
use App\Modules\TypePopulation\Domain\Repositories\ITypePopulationRepository;
use App\Modules\TypeSchool\Domain\Repositories\ITypeSchoolRepository;

use App\Modules\School\Application\DTOs\CreateSchoolDTO;
use App\Modules\School\Application\DTOs\DuplicatedSchoolDTO;


class CreateSchoolAction
{

	public function __construct(
		protected ISchoolRepository $oSchoolRepository,
		protected IStateRepository $oStateRepository,
		protected ICityRepository $oCityRepository,
		protected IDistrictRepository $oDistrictRepository,
		protected ITypeDocumentRepository $oTypeDocumentRepository,
		protected ITypePopulationRepository $oTypePopulationRepository,
		protected ITypeSchoolRepository $oTypeSchoolRepository
	)
	{
	}

	public function execute(CreateSchoolDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oSchoolRepository->getEntity();
		$oDataDuplicated = new DuplicatedSchoolDTO(
			Id_School	: 0,
			School_NoDocument : $oData->School_NoDocument,
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

			$oResult = $this->oTypeSchoolRepository->exists($oData->Id_TypeSchool);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	return $oResult; }


			$oResult = $this->oSchoolRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oSchoolRepository->create($oData);
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