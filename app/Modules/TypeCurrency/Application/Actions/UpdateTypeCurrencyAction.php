<?php

namespace App\Modules\TypeCurrency\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypeCurrency\Application\DTOs\UpdateTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\DuplicatedTypeCurrencyDTO;


class UpdateTypeCurrencyAction
{
	protected ITypeCurrencyRepository $oTypeCurrencyRepository;

	public function __construct(ITypeCurrencyRepository $oTypeCurrencyRepository)
	{
		$this->oTypeCurrencyRepository = $oTypeCurrencyRepository;
	}

	public function execute(UpdateTypeCurrencyDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeCurrencyRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeCurrencyDTO(
			Id_TypeCurrency	: $oData->Id_TypeCurrency,
			TypeCurrency_Code	: $oData->TypeCurrency_Code,
			TypeCurrency_Name	: $oData->TypeCurrency_Name,
			TypeCurrency_Symbol	: $oData->TypeCurrency_Symbol
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

			$oResult = $this->oTypeCurrencyRepository->duplicated($oDataDuplicated);
			if ( $oResult->RESULT_STS <> 200 ){ DB::rollBack(); return $oResult; }

			$oResult = $this->oTypeCurrencyRepository->update($oData);
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