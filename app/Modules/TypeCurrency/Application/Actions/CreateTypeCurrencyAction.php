<?php

namespace App\Modules\TypeCurrency\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypeCurrency\Application\DTOs\CreateTypeCurrencyDTO;
use App\Modules\TypeCurrency\Application\DTOs\DuplicatedTypeCurrencyDTO;


class CreateTypeCurrencyAction
{
	protected ITypeCurrencyRepository $oTypeCurrencyRepository;

	public function __construct(ITypeCurrencyRepository $oTypeCurrencyRepository)
	{
		$this->oTypeCurrencyRepository = $oTypeCurrencyRepository;
	}

	public function execute(CreateTypeCurrencyDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeCurrencyRepository->getEntity();
		$oDataDuplicated = new DuplicatedTypeCurrencyDTO(
			Id_TypeCurrency	: 0,
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

			$oResult = $this->oTypeCurrencyRepository->create($oData);
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