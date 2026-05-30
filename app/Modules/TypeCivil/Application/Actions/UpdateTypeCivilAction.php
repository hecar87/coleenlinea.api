<?php

namespace App\Modules\TypeCivil\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeCivil\Domain\Repositories\ITypeCivilRepository;
use App\Modules\TypeCivil\Application\DTOs\UpdateTypeCivilDTO;
use App\Modules\TypeCivil\Application\DTOs\DuplicatedTypeCivilDTO;


class UpdateTypeCivilAction
{

	public function __construct(
		protected ITypeCivilRepository $oTypeCivilRepository
	)
	{
	}

	public function execute(UpdateTypeCivilDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeCivilRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeCivilDTO(
			Id_TypeCivil	: $oData->Id_TypeCivil,
			TypeCivil_Name	: $oData->TypeCivil_Name,
			TypeCivil_Abrv	: $oData->TypeCivil_Abrv
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

			$oResult = $this->oTypeCivilRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeCivilRepository->update($oData);
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