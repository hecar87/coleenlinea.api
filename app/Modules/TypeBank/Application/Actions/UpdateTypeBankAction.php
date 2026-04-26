<?php

namespace App\Modules\TypeBank\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeBank\Repositories\ITypeBankRepository;
use App\Application\TypeBank\DTOs\UpdateTypeBankDTO;
use App\Application\TypeBank\DTOs\DuplicatedTypeBankDTO;


class UpdateTypeBankAction
{
	protected ITypeBankRepository $oTypeBankRepository;

	public function __construct(ITypeBankRepository $oTypeBankRepository)
	{
		$this->oTypeBankRepository = $oTypeBankRepository;
	}

	public function execute(UpdateTypeBankDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeBankRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeBankDTO(
			Id_TypeBank		: $oData->Id_TypeBank,
			TypeBank_Code	: $oData->TypeBank_Code,
			TypeBank_Name	: $oData->TypeBank_Name,
			TypeBank_Abrv	: $oData->TypeBank_Abrv
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

			$oResult = $this->oTypeBankRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeBankRepository->update($oData);
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