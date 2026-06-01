<?php

namespace App\Modules\District\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\District\Domain\Repositories\IDistrictRepository;
use App\Modules\City\Domain\Repositories\ICityRepository;

use App\Modules\District\Application\DTOs\CreateDistrictDTO;
use App\Modules\District\Application\DTOs\DuplicatedDistrictDTO;


class CreateDistrictAction
{

	public function __construct(
		protected IDistrictRepository $oDistrictRepository,
		protected ICityRepository $oCityRepository
	)
	{
	}

	public function execute(CreateDistrictDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oDistrictRepository->getEntity();
		$oDataDuplicated = new DuplicatedDistrictDTO(
			Id_District		: 0,
			District_Code	: $oData->District_Code,
			District_Name	: $oData->District_Name,
			Id_City			: $oData->Id_City
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

			$oResult = $this->oCityRepository->exists($oData->Id_City);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oDistrictRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oDistrictRepository->create($oData);
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