<?php

namespace App\Modules\State\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\State\Domain\Repositories\IStateRepository;
use App\Modules\State\Application\DTOs\CreateStateDTO;
use App\Modules\State\Application\DTOs\DuplicatedStateDTO;


class CreateStateAction
{

	public function __construct(
		protected IStateRepository $oStateRepository
	)
	{
	}

	public function execute(CreateStateDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oStateRepository->getEntity();
		$oDataDuplicated = new DuplicatedStateDTO(
			Id_State	: 0,
			State_Code	: $oData->State_Code,
			State_Name	: $oData->State_Name,
			State_Abrv	: $oData->State_Abrv
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

			$oResult = $this->oStateRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oStateRepository->create($oData);
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