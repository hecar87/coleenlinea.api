<?php

namespace App\Modules\TypeCurrency\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Domain\TypeCurrency\Repositories\ITypeCurrencyRepository;
use App\Application\TypeCurrency\DTOs\SearchTypeCurrencyDTO;

class SearchTypeCurrencyAction
{
	protected ITypeCurrencyRepository $oTypeCurrencyRepository;

	public function __construct(ITypeCurrencyRepository $oTypeCurrencyRepository)
	{
		$this->oTypeCurrencyRepository = $oTypeCurrencyRepository;
	}

	public function execute(SearchTypeCurrencyDTO $oData) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity = $this->oTypeCurrencyRepository->getEntity();


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeCurrencyRepository->search($oData);
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