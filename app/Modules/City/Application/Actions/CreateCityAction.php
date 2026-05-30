<?php

namespace App\Modules\City\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\City\Domain\Repositories\ICityRepository;
use App\Modules\State\Domain\Repositories\IStateRepository;
use App\Modules\City\Application\DTOs\CreateCityDTO;
use App\Modules\City\Application\DTOs\DuplicatedCityDTO;


class CreateCityAction
{

	public function __construct(
		protected ICityRepository $oCityRepository,
		protected IStateRepository $oStateRepository
	)
	{
	}

	public function execute(CreateCityDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oCityRepository->getEntity();
		$oDataDuplicated = new DuplicatedCityDTO(
			Id_City		: 0,
			City_Code	: $oData->City_Code,
			City_Name	: $oData->City_Name,
			Id_State	: $oData->Id_State
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
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack();	 return $oResult; }

			$oResult = $this->oCityRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oCityRepository->create($oData);
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