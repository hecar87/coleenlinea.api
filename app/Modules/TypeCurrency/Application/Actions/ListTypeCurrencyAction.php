<?php

namespace App\Modules\TypeCurrency\Application\Actions;

use Illuminate\Support\Facades\DB;
use App\Helpers\Result;
use App\Helpers\ResultManager;

use App\Modules\TypeCurrency\Domain\Repositories\ITypeCurrencyRepository;
use App\Modules\TypeCurrency\Domain\Enums\TypeCurrencyFilterDisplay;


class ListTypeCurrencyAction
{

	public function __construct(
		protected ITypeCurrencyRepository $oTypeCurrencyRepository
	)
	{
	}

	public function execute(string $Display) : Result
	{
		//------------------------------------------------------------------------------
		//	VARIABLES
		//------------------------------------------------------------------------------
		$oEntity 	= $this->oTypeCurrencyRepository->getEntity();
		$oDisplay 	= TypeCurrencyFilterDisplay::from(strtoupper($Display));


		//------------------------------------------------------------------------------
		//	FUNCTION
		//------------------------------------------------------------------------------
		try
		{
			//
			//	TRANSACTION
			//
			DB::beginTransaction();

			$oResult = $this->oTypeCurrencyRepository->list($oDisplay);
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