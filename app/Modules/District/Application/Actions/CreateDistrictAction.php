<?php

namespace App\Application\District\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\District\Repositories\IDistrictRepository;
use App\Application\District\DTOs\CreateDistrictDTO;
use App\Application\District\DTOs\DuplicatedDistrictDTO;


class CreateDistrictAction
{
	protected IDistrictRepository $oDistrictRepository;

	public function __construct(IDistrictRepository $oDistrictRepository)
	{
		$this->oDistrictRepository = $oDistrictRepository;
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